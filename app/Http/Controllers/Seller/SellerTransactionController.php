<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerTransactionController extends ApiController
{
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