<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general');
        $this->middleware('can:view,seller');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Seller $seller)
    {
        $trasactions = $seller->products()
                    ->whereHas('transactions')
                    ->with('transactions')
                    ->get()
                    ->pluck('transactions')
                    ->collapse(); //Une todas los array que devuelve pluck
                            
        return $this->showAll($trasactions);
    }
}
