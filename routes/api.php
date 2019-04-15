<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::get('/persons', 'PersonController@index')->name('persons.index');

Route::post('/persons', 'PersonController@store')->name('persons.store');

Route::get('/persons/{person}', 'PersonController@show')->name('persons.show');

Route::get('/persons/getPersonById/{Id}', 'PersonController@getPersonById')->name('persons.getPersonById');

Route::put('/persons/{person}', 'PersonController@update')->name('persons.update');

Route::delete('/persons/{person}', 'PersonController@destory')->name('persons.destroy');

Route::post('/persons/getChildrenOrSponsors', 'PersonController@getChildrenOrSponsors')->name('persons.getChildrenOrSponsors');

Route::post('/persons/findSponsors', 'PersonController@findSponsors')->name('persons.findSponsors');

Route::get('/childrensponsors', 'ChildrenSponsorsController@index')->name('childrensponsors.index');

Route::post('/childrensponsors', 'ChildrenSponsorsController@store')->name('childrensponsors.store');

Route::get('/childrensponsors/getChildSponsors/{childId}', 'ChildrenSponsorsController@getChildSponsors')->name('childrensponsors.getChildSponsors');

Route::post('/contributions', 'ContributionsController@store')->name('contributions.store');

Route::get('/contributions', 'ContributionsController@index')->name('contributions.index');

Route::get('/contributions/{childId}', 'ContributionsController@show')->name('contributions.show');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
