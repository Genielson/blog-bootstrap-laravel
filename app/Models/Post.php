<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['description','title','user_id'];

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function categories(){
        return $this->belongsToMany(Category::class,'post_categories');
    }
}
