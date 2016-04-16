<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09/02/16
 * Time: 10:07
 * Scampini
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('users')->truncate();

        factory('CodeCommerce\User')->create(
            [
                'name'=> 'fscampini',
                'email' => 'fscampini@gmail.com',
                'password' => Hash::make(123456),
                'is_admin' => true
            ]
        );
        factory('CodeCommerce\User', 10)->create();
    }
}