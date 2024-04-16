<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SellOrder extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'sell_orders';
    protected $fillable = ['product_id', 'quantity']; 
}
