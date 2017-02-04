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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => $faker->imageUrl(100, 100),
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
        'confirmation_token' => str_random(60),
        'is_active' => 1,
    ];
});

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'bio' => $faker->paragraph,
        'followers_count' => 1
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    $users = array_column(\App\User::all(['id'])->toArray(), 'id');
    return [
        'user_id' => array_rand($users, 1),
        'title' => $faker->sentence(rand(3, 6)),
        'body' => $faker->text(100),
        'followers_count' => 1
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    $users = array_column(\App\User::all('id')->toArray(), 'id');
    $questions = array_column(\App\Question::all('id')->toArray(), 'id');
    return [
        'user_id' => array_rand($users, 1),
        'question_id' => array_rand($questions, 1),
        'body' => $faker->text(20)
    ];
});