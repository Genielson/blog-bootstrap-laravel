<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title','url_image'];

    function posts(){
        return $this->hasMany(Post::class,'post_categories');
    }
}
