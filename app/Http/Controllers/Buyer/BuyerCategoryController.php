<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Buyer $buyer)
    {
        //obteniendo los vendedores sin repetirlos a partir de un comprador
        //BuyeR --> Transactions <-- Product -- Seller
        $sellers = $buyer->transactions()->with('product.categories')
                            ->get()
                            ->pluck('product.categories')
                            ->collapse()
                            ->unique('id')
                            ->values();
                            
        return $this->showAll($sellers);
    }
}
