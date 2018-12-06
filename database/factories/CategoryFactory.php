<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Category::class, function (Faker $faker) {
    return [
            'category_no'=>mt_rand(1000000, 9999999),
            'name'=>$faker->sentence,
            'name_en'=>$faker->sentence,
            'image'=>NULL,
            'info'=>$faker->text,
            'info_en'=>$faker->text,
            'parent_id'=>mt_rand(10, 20),
            'display'=>1,
            'created_by_id'=>1,
            'updated_by_id'=>1,
            'view'=>0,
            'layer'=>2,
    ];
});
