<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(2)->create();
         DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
         ]);

         DB::table('products')->insert([
            'pr_name' => 'Deneme Ürün 1',
            'pr_quantity' => 100,
            'pr_price' => 100,
            'pr_status' => 1,
            'created_at' => now(),
            'updated_at' => now()
         ]);
    }
}
