<?php

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
        factory(App\Area::class, 3)->create();
        factory(App\City::class, 9)->create();
        factory(App\Region::class, 18)->create();
    }
}
