<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Product extends Model
{
    protected $table = 'user_product';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];
}
