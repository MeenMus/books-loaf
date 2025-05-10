<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'genre',
        'price',
        'stock',
        'cover_image',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
