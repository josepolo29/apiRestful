<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        $trasactions = $category->products()->with('transactions')
                    ->whereHas('transactions')
                    ->get()
                    ->pluck('transactions')
                    ->collapse(); //Une todas los array que devuelve pluck
                            
        return $this->showAll($trasactions);
    }
}
