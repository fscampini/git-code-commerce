<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09/02/16
 * Time: 10:07
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Category;

class ProductTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('products')->truncate();
        factory('CodeCommerce\Product', 15)->create();
    }

}