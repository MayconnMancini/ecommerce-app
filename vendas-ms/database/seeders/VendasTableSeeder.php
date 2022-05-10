<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Venda::factory(10)->create();
    }
}
