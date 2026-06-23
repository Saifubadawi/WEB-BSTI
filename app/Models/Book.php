<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'cover_image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
