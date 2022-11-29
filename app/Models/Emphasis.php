<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Emphasis extends Model
{
    use HasFactory;

    protected $fillable = ['post_id'];
    protected $table = 'emphasis';
    function post(){
            return $this->belongsTo(Post::class,'post_id');
    }

    public static function getEmphasisById(int $id):array {
        return Emphasis::select()
        ->where('post_id','=',$id)->get()->toArray();
    }
}
