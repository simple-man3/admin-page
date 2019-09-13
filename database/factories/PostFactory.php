<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->name;
    return [
        'title' => $title,
        'slug' => $faker->slug(4),
        'content' => '<h1>'.$title.'</h1><p>'.$faker->realText().'</p>',
        'author_id' => 1
    ];
});
