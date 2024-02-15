<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'code',
        'price',
        'expiry_date'
    ];
    public function freeIssues()
    {
        return $this->hasMany(FreeIssue::class, 'purchase_product', 'id');
    }
    public function orders(){
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id');
    }
}
