<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function product(){
        return $this->hasOne(ShopProduct::class);
    }

}
