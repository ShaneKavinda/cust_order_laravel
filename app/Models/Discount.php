<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'discount',
        'lower_limit',
        'upper_limit'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
