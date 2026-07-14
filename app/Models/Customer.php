<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{ 
    use SoftDeletes;
    protected $fillable = [
    'shopkeeper_id',
    'customer_name',
    'phone',
    'email',
    'gender',
    'address'
];
public function previousRecords()
{
    return $this->hasMany(PreviousRecord::class);
}
}
