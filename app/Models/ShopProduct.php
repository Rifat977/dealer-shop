<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'buying_price', 'price', 'stock'];

    public function category(){
        return $this->belongsTo(ShopCategory::class, 'category_id', 'id');
    }

}
