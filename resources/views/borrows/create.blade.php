@extends('layouts.master')

@section('content')
<h1>Add Borrow</h1>

<form method="POST" action="{{ route('borrows.store') }}">
    @csrf
    <div class="mb-3">
        <label for="book_id" class="form-label">Book</label>
        <select class="form-control" id="book_id" name="book_id" required>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->name }} by {{ $book->author }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Reader Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Reader Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="borrow_date" class="form-label">Borrow Date</label>
        <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
    </div>
    <div class="mb-3">
        <label for="return_date" class="form-label">Expected Return Date</label>
        <input type="date" class="form-control" id="return_date" name="return_date">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection