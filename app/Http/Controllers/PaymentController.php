<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Payment;
use App\Models\Reader;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['book', 'user', 'borrow']);

        if (auth()->user()->isAdmin()) {
            if ($request->filled('payment_status')) {
                $query->where('payment_status', $request->payment_status);
            }

            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            if ($request->filled('book_id')) {
                $query->where('book_id', $request->book_id);
            }

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }
        } else {
            $query->where('user_id', auth()->id());
        }

        $payments = $query->latest()->paginate(10);
        $books = Book::orderBy('name')->get();
        $users = auth()->user()->isAdmin() ? User::orderBy('name')->get() : collect();

        return view('payments.index', compact('payments', 'books', 'users'));
    }

    public function create(Request $request, Book $book)
    {
        $type = $request->get('type', 'purchase');

        if (!in_array($type, ['purchase', 'borrow'])) {
            $type = 'purchase';
        }

        if ($type === 'borrow' && $book->status !== 'available') {
            return redirect()->route('books.show', $book)->with('error', 'Sách này hiện không có sẵn để mượn.');
        }

        $amount = $type === 'purchase'
            ? $book->price
            : round($book->price * 0.3, 2);

        return view('payments.create', compact('book', 'type', 'amount'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'type' => 'required|in:purchase,borrow',
            'payment_method' => 'required|in:cash,bank_transfer,momo',
            'notes' => 'nullable|string|max:1000',
            'borrow_date' => 'nullable|date',
            'return_date' => 'nullable|date|after:borrow_date',
        ]);

        $type = $request->type;

        if ($type === 'borrow' && $book->status !== 'available') {
            return redirect()->route('books.show', $book)->with('error', 'Sách này hiện không có sẵn để mượn.');
        }

        if ($type === 'borrow' && (!$request->borrow_date || !$request->return_date)) {
            return back()->withErrors([
                'borrow_date' => 'Vui lòng chọn ngày mượn và ngày trả dự kiến.',
            ])->withInput();
        }

        $amount = $type === 'purchase'
            ? $book->price
            : round($book->price * 0.3, 2);

        Payment::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'type' => $type,
            'borrow_date' => $type === 'borrow' ? $request->borrow_date : null,
            'return_date' => $type === 'borrow' ? $request->return_date : null,
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('payments.index')->with('success', 'Yêu cầu thanh toán đã được tạo. Vui lòng chờ admin xác nhận.');
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $request->validate([
            'payment_status' => 'required|in:pending,paid,cancelled',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        if ($payment->payment_status === 'paid' && $request->payment_status === 'cancelled') {
            return redirect()->route('payments.index')->with('error', 'Không thể hủy một giao dịch đã thanh toán.');
        }

        $data = [
            'payment_status' => $request->payment_status,
            'admin_note' => $request->admin_note,
            'paid_at' => $request->payment_status === 'paid' ? now() : null,
        ];

        if (
            $request->payment_status === 'paid' &&
            $payment->type === 'borrow' &&
            !$payment->borrow_id
        ) {
            $book = $payment->book;

            if ($book->status !== 'available') {
                return redirect()->route('payments.index')->with('error', 'Sách này không còn sẵn để xác nhận mượn.');
            }

            $reader = Reader::firstOrCreate(
                ['email' => $payment->user->email],
                ['name' => $payment->user->name]
            );

            $borrow = Borrow::create([
                'book_id' => $payment->book_id,
                'reader_id' => $reader->id,
                'borrow_date' => $payment->borrow_date ?? now()->toDateString(),
                'return_date' => $payment->return_date,
                'status' => 'borrowed',
            ]);

            $book->update([
                'status' => 'unavailable',
            ]);

            $data['borrow_id'] = $borrow->id;
        }

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Trạng thái thanh toán đã được cập nhật.');
    }
}
