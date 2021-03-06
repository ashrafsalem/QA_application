<?php

use Illuminate\Support\Facades\Route;

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
route::resource('questions', 'QuestionsController')->except('show');
route::resource('question.answers', 'AnswersController')->except(['index', 'create', 'show']);
route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show');
route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');
route::post('/questions/{question}/favorited', 'FavoriteController@store')->name('questions.favorite');
route::delete('/questions/{question}/favorited','FavoriteController@destroy')->name('questions.unFavorite');

route::post('/questions/{question}/vote', 'VoteQuestionController');
route::post('/answers/{answer}/vote', 'VoteAnswerController');

