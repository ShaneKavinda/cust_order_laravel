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
        return $this->hasOne(FreeIssue::class, 'purchase_product', 'id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'free', 'amount')->withTimestamps();
    }
    public function orderproducts(){
        return $this->hasMany(OrderProduct::class);
    }

    public function discounts(){
        return $this->hasMany(Discounts::class);
    }
}
