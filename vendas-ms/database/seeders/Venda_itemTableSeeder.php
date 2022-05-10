<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Venda_itemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Venda_item::factory(30)->create();
    }
}
