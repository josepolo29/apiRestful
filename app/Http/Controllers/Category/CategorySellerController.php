<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategorySellerController extends ApiController
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
        
        $sellers = $category->products()->with('seller')
                    ->get()
                    ->pluck('seller')
                    ->unique()
                    ->values();
                            
        return $this->showAll($sellers);
    }
}
