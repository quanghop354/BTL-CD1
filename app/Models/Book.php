<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

<<<<<<< HEAD
    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status'];
=======
<<<<<<< HEAD
    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status'];
=======
<<<<<<< HEAD
<<<<<<< HEAD
    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status', 'publisher_id'];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
=======
    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status'];
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
    protected $fillable = ['name', 'slug', 'author', 'price', 'description', 'image', 'status'];
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
}
