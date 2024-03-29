<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general');
        $this->middleware('can:view,buyer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Buyer $buyer)
    {
        $products = $buyer->transactions()->with('product')
                            ->get()
                            ->pluck('product');
                            
        return $this->showAll($products);
    }
}
