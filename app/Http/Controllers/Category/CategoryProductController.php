<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryProductController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        $products = $category->products;
                            
        return $this->showAll($products);
    }
}
