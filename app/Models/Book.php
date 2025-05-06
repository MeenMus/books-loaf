<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Genre::class, 'genre');
    }
}
