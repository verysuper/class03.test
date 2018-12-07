<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Merchandise::class, function (Faker $faker) {
    return [
            'merchandise_no'=>mt_rand(1000000, 9999999),
            'name'=>$faker->sentence,
            'name_en'=>$faker->sentence,
            'image'=>NULL,
            'info'=>$faker->text,
            'info_en'=>$faker->text,
            'category_id'=>mt_rand(20, 30),
            'remain_qty'=>mt_rand(20, 30),
            'display'=>'1',
            'created_by_id'=>1,
            'updated_by_id'=>1,
            'view'=>0,
            'price'=>mt_rand(1000000, 9999999),
            'brand_id'=>mt_rand(1, 10),
            'vendor_id'=>mt_rand(1, 10),
            'highly_qty'=>mt_rand(0, 9999999),
            'destroy'=>'0',
    ];
});
