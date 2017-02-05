<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('email/{token}', 'EmailController@confirm')->name('email.confirm');

Route::get('users/notifications', 'NotificationsController@index')->name('users.notifications');

Route::post('questions', 'QuestionsController@store')->name('questions.store');
Route::get('questions', 'QuestionsController@index')->name('questions.index');
Route::get('questions/create', 'QuestionsController@create')->name('questions.create');
Route::patch('questions/{question}', 'QuestionsController@update')->name('questions.update');
Route::get('questions/{question}', 'QuestionsController@show')->name('questions.show');
Route::delete('questions/{question}', 'QuestionsController@destroy')->name('questions.destroy');
Route::get('questions/{question}/edit', 'QuestionsController@edit')->name('questions.edit');

Route::post('questions/{question}/answers', 'AnswersController@store')->name('answers.store');

Route::get('users/{user}', 'UsersController@show')->name('users.show');
