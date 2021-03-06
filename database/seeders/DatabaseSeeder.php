<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class DatabaseSeeder extends Seeder
{
    private const USERS_QUANTITY = 1000;
    private const CATEGORIES_QUANTITY = 10;
    private const PRODUCTS_QUANTITY = 200;
    private const TRANSACTIONS_QUANTITY = 50;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeyChecks();
        $this->renewDatabase();

        $this->command->getOutput()->progressStart(10);
        for ($i = 0; $i < 10; $i++) {
            sleep(1);
            User::factory()->count(self::USERS_QUANTITY)->create();
            Category::factory()->count(self::CATEGORIES_QUANTITY)->create();
            Product::factory()->count(self::PRODUCTS_QUANTITY)->create()->each(
                function (Product $product) {
                    $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
    
                    $product->categories()->attach($categories);
                });
            Transaction::factory()->count(self::TRANSACTIONS_QUANTITY)->create();
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }

    /**
     * Truncate all previous data stored.
     */
    private function renewDatabase()
    {
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();
    }

    /**
     * Disable FK checks. 
     */
    private function disableForeignKeyChecks() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
