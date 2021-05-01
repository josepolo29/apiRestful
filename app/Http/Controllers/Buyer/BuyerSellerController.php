<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerSellerController extends ApiController
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
    public function __invoke(Buyer $buyer)
    {

        $this->allowedAdminAction();
        
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
