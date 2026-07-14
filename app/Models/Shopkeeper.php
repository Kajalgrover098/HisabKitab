<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shopkeeper extends Model
{
    
    use SoftDeletes;

    protected $fillable = [

        'shop_name',

        'owner_name',

        'email',

        'phone',

        'password',
        'address',
        'status'

    ];
    
}