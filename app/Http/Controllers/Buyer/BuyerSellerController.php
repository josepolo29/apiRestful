<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Buyer $buyer)
    {
        //obteniendo los vendedores sin repetirlos a partir de un comprador
        //BuyeR --> Transactions <-- Product -- Seller
        $sellers = $buyer->transactions()->with('product.seller')
                            ->get()
                            ->pluck('product.seller')
                            ->unique('id')
                            ->values();
                            
        return $this->showAll($sellers);
    }
}
