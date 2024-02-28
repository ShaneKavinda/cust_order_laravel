<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'net_amount'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'free', 'amount', 'discount', 'subtotal')->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
     
     public function orderProduct()
     {
         return $this->hasMany(OrderProduct::class);
     }
}
