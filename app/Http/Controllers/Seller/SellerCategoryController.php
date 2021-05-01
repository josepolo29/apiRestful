<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerCategoryController extends ApiController
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
        $trasactions = $seller->products()->with('categories')
                    ->get()
                    ->pluck('categories')
                    ->collapse() //Une todas los array que devuelve pluck
                    ->unique('id')
                    ->values(); //elimina los elementos vacios
                    
        return $this->showAll($trasactions);
    }
}
