<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product)
    {
        $this->allowedAdminAction();
        
        $buyers = $product->transactions()
                        ->with('buyer')
                        ->get()
                        ->pluck('buyer')
                        ->unique('id')
                        ->values();
                            
        return $this->showAll($buyers);
    }
}
