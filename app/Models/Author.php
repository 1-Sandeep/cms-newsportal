<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $fillable = ['name', 'description', 'is_active', 'image'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_author');
    }
}
