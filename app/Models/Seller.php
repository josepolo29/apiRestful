<?php

namespace App\Models;

use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;

class Seller extends User
{
    public $transformer = SellerTransformer::class;

    protected static function booted()
    {
        static::addGlobalScope(new SellerScope);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    
}
