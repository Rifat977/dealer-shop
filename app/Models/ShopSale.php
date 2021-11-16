<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSale extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function product()
    {
        return $this->morphMany(SaleProduct::class, 'holder');
    }

}
