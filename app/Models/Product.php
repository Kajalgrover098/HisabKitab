<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
      use SoftDeletes;
  protected $fillable = [
    'shopkeeper_id',
    'product_name',
    'product_code',
    'price',
    'unit',
    'stock',
    'status'
];
}
