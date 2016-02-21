<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * Scampini
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        $this->call('UserTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('ProductTableSeeder');


        Model::reguard();
    }
}
