<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // For Users
    public function index()
    {
        $carts = Cart::with('book')->where('user_id', Auth::id())->get();
        return view('carts.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $book_id = $request->book_id;
        $quantity = $request->quantity ?? 1;

        $cart = Cart::where('user_id', Auth::id())->where('book_id', $book_id)->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sách vào giỏ hàng.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('carts.index')->with('success', 'Đã cập nhật số lượng.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Đã xóa khỏi giỏ hàng.');
    }

    // For Admins
    public function adminIndex()
    {
        $carts = Cart::with(['user', 'book'])->orderBy('user_id')->get();
        // Group by user if preferred, or just display a list
        return view('admin.carts.index', compact('carts'));
    }
}
