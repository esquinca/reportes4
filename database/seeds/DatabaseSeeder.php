<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //Deshabilita la revision de foreign key
        $this->call(UsersTableSeeder::class);
        // $this->call(HotelsTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //Habilita la revision de foreign key
    }
}
