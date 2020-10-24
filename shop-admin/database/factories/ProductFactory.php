<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {

    $albumImage = "products/album_image/p1.jpg,products/album_image/p2.jpg,products/album_image/p3.jpg";
    $albumImage .=",products/album_image/p4.jpg,products/album_image/p5.jpg,products/album_image/p6.jpg";
    $contentImage = "products/content_image/p1.jpg,products/content_image/p2.jpg,products/content_image/p3.jpg";
    $contentImage .= ",products/content_image/p4.jpg,products/content_image/p5.jpg,products/content_image/p6.jpg,products/content_image/p7.jpg";
    // 从数据库中随机取一个类目
    $catalog = \App\Models\Catalog::query()->where('is_directory', false)->inRandomOrder()->first();

    return [
        'title'        => $faker->word,
        'long_title'   => $faker->sentence,
        'on_sale'      => true,
        'cover_image'  => 'products/cover_image/p'.random_int(1,10).".webp" ,
        'album_image'  => $albumImage,
        'content_image'  => $contentImage,
        'rating'       => $faker->numberBetween(0, 5),
        'sold_count'   => 0,
        'review_count' => 0,
        'price'        => 0,
        // 将取出的类目 ID 赋给 category_id 字段
        // 如果数据库中没有类目则 $category 为 null，同样 category_id 也设成 null
        'catalog_id'  => $catalog ? $catalog->id : null,
    ];
});
