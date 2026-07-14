<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $fillable = [
    'billing_id',
    'product_id',
    'qty',
    'price',
    'amount'
];
public function product()
{
    return $this->belongsTo(Product::class);
}
}
