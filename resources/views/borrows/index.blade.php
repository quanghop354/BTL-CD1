@extends('layouts.master')

@section('content')
<h1>Borrows</h1>

<a href="{{ route('borrows.create') }}" class="btn btn-primary mb-3">Add Borrow</a>

<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <select name="book_id" class="form-control">
                <option value="">All Books</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ request('book_id') == $book->id ? 'selected' : '' }}>{{ $book->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="reader_id" class="form-control">
                <option value="">All Readers</option>
                @foreach($readers as $reader)
                    <option value="{{ $reader->id }}" {{ request('reader_id') == $reader->id ? 'selected' : '' }}>{{ $reader->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-secondary">Filter</button>
        </div>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Book</th>
            <th>Reader</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $borrow)
            <tr>
                <td>{{ $borrow->book->name }}</td>
                <td>{{ $borrow->reader->name }} ({{ $borrow->reader->email }})</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->return_date ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $borrow->status == 'returned' ? 'success' : 'warning' }}">
                        {{ ucfirst($borrow->status) }}
                    </span>
                </td>
                <td>
                    @if($borrow->status == 'borrowed')
                        <form method="POST" action="{{ route('borrows.return', $borrow) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Return</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $borrows->appends(request()->query())->links() }}
@endsection