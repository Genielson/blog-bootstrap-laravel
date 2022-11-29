<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','category_id'];


    public static function getPostCategoryById(int $id):array{
        return PostCategory::select('category_id')->
        where('post_id', "=",$id)->pluck('category_id')->toArray();
    }


}
