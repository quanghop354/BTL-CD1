<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['book_id', 'reader_id', 'borrow_date', 'return_date', 'status'];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
