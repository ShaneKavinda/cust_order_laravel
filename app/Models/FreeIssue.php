<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeIssue extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'type',
        'purchase_product',
        'free_product',
        'purchase_quantity',
        'free_quantity',
        'lower_limit',
        'upper_limit'
    ];
    public function purchase_product()
    {
        return $this->belongsTo(Product::class, 'purchase_product_id');
    }

    public function free_product()
    {
        return $this->belongsTo(Product::class, 'free_product_id');
    }
}
