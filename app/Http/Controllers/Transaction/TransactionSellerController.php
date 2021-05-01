<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;

class TransactionSellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general');
        $this->middleware('can:view,transaction');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Transaction $transaction)
    {
        $seller = $transaction->product->seller;
        return $this->showOne($seller);
    }
}
