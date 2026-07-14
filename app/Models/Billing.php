<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
     protected $fillable = [
    'shopkeeper_id',
    'customer_id',
    'total_amount',
    'paid_amount',
    'due_amount',
    'status'
];
public function items()
{
    return $this->hasMany(BillItem::class, 'billing_id');
}

public function customer()
{
    return $this->belongsTo(Customer::class);
}
public function shopkeeper()
{
   return $this->belongsTo(Shopkeeper::class, 'shopkeeper_id', 'shop_id');
}
}
