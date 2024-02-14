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
}
