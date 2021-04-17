<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product)
    {
        $trasactions = $product->transactions;
                            
        return $this->showAll($trasactions);
    }
}
