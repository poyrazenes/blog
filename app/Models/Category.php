<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Base
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'slug', 'title', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
}
