<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status', 'publisher_id'];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function readers()
    {
        return $this->belongsToMany(Reader::class, 'borrows');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}
