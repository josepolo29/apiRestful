<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $quantityUser = 1000;
        $quantityCategories = 30;
        $quantityProducts = 1000;
        $quantityTransactions = 1000;

        User::factory()->count($quantityUser)->create();
        Category::factory()->count($quantityCategories)->create();

        Product::factory()->count($quantityProducts)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

                $product->categories()->attach($categories->first());
            }
        );

        Transaction::factory()->count($quantityTransactions)->create();
    }
}
