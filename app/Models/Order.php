<?php

namespace App\Models;

use App\Models\Chef;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'total',
        'type',
        'status',
        'chef_id',
        'customer_id',
        'product_id',
        'begin',
        'end',
        'timeframe',
    ];

    public function chef(){
        return $this->belongsTo(Chef::class, 'chef_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
