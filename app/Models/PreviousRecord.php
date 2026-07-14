<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreviousRecord extends Model
{
    protected $fillable = [

        'shopkeeper_id',

        'customer_id',

        'total_amount',

        'paid_amount',

        'due_amount',

        'type',

        'description',

        'status'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}