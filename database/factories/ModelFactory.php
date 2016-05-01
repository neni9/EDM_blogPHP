<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role'           => 'visitor'
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

	$titlePost = [
	    'Symfony Live Madrid '.rand(2008,2018),
	    'Symfony Live London'.rand(2008,2018),
	    'PHP Tour '.rand(2008,2018),
	    'Laracon NY '.rand(2008,2018),
	    'Laracon Amsterdam '.rand(2008,2018),
	    'PHP 7',
	    'Nouveautés à venir sur PHP',
	    'Laravel'
	];

    return [
        'title' => $titlePost[array_rand($titlePost)],
        'content' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Praesent vel ligula scelerisque, vehicula dui eu, fermentum velit. 
                    Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum. In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus, mauris justo volutpat elit, eget accumsan nulla nisi ut nisi. Etiam non convallis ligula.Nulla urna augue, dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.Lorem ipsum dolor sit amet,consectetur adipiscing elit. Praesent velvehicula dui eu, fermentum velit. Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum. In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus, mauris justo volutpat elit, eget accumsan nulla nisi ut nisi. Etiam non convallis ligula. Nulla urna augue, dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.Lorem ipsum dolor sit amet, consectetur adipiscing elitPraesent vel ligula scelerisque, vehicula dui eu, fermentum velitPhasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentumIn in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursusmauris justo volutpat eliteget accumsan nulla nisi ut nisi. Etiam non convallis ligula. Nulla urna auguedignissim ac semper in, ornare ac mauris. Duis nec felis mauris.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel ligula scelerisque, vehicula dui eu, fermentum velit. Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum. In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus, mauris justo volutpat elit, eget accumsan nulla nisi ut nisi. Etiam nNulla urna augue, dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.Lorem iconsectetur adipiscing elit. Praesent vel ligula scelerisque, vehicula dui eu, fermentum velit. Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum. In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus, mauris justo volutpat elit, eget accumsan nulla nisi ut nisi. Etiam non convallis ligula. Nulla urna augue, dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.',
        'user_id' => rand(1, 3),
        'category_id' => rand(1, 2),
        'status' => rand(1,2),
        'published_at' => $faker->dateTimeBetween("2015-01-01 00:00:00","2016-04-29 19:00:00")->format('Y-m-d H:i:s')
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,

    ];
});

$factory->define(App\Picture::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,

    ];
});
