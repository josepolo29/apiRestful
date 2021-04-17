<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerCategoryController extends ApiController
{
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
