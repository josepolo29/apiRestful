<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBuyerController extends ApiController
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
    public function __invoke(Category $category)
    {
        $this->allowedAdminAction();
        
        $trasactions = $category->products()
                    ->whereHas('transactions')
                    ->with('transactions.buyer')
                    ->get()
                    ->pluck('transactions')
                    ->collapse() //Une todas los array que devuelve pluck
                    ->pluck('buyer')
                    ->unique()
                    ->values();
                            
        return $this->showAll($trasactions);
    }
}
