<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image',
        'name',
        'sku',
        'description',
        'price',
        'quantity',
        'category_id',
        'is_active',
    ];
}
