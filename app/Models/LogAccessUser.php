<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAccessUser extends Model
{
    use HasFactory;
    protected $table = 'logaccess';
    protected $fillable = ['log'];
}
