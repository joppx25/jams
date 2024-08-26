<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'shipment_fee',
        'other_fees',
    ];
}
