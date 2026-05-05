<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = Shelf::paginate(10);
        return view('shelves.index', compact('shelves'));
    }

    public function create()
    {
        return view('shelves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Shelf::create($request->all());

        return redirect()->route('shelves.index')->with('success', 'Đã thêm kệ sách thành công.');
    }

    public function edit(Shelf $shelf)
    {
        return view('shelves.edit', compact('shelf'));
    }

    public function update(Request $request, Shelf $shelf)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $shelf->update($request->all());

        return redirect()->route('shelves.index')->with('success', 'Đã cập nhật kệ sách thành công.');
    }

    public function destroy(Shelf $shelf)
    {
        $shelf->delete();
        return redirect()->route('shelves.index')->with('success', 'Đã xóa kệ sách.');
    }
}
