<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable = ['title', 'description', 'summary', 'image', 'is_published'];

    public function author()
    {
        return $this->belongsToMany(Author::class, 'post_author');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
