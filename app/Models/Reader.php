<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = ['name', 'email'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrows');
    }
}
