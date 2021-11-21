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
    return redirect(route('login'));
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::prefix('home')->name('home.')->middleware('auth', 'access.right:superadmin,admin,family_head')->group(function () {
    Route::get('/', function () {
        return redirect(route('home.dashboard'));
    })->name('index');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
});

Route::prefix('user')->name('user.')->middleware('auth', 'access.right:superadmin')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::put('/update/{id}', 'UserController@update')->name('update');
    Route::put('/update-password/{id}', 'UserController@updatePassword')->name('update.password');
});

Route::prefix('person')->name('person.')->middleware('auth', 'access.right:superadmin,admin,family_head')->group(function () {
    Route::get('/', 'PersonController@index')->name('index');
    Route::get('/search', 'PersonController@search')->name('search');
    Route::get('/show/{id}', 'PersonController@show')->name('show');
    Route::get('/create', 'PersonController@create')->name('create');
    Route::post('/store', 'PersonController@store')->name('store');
    Route::get('/edit/{id}', 'PersonController@edit')->name('edit');
    Route::put('/update/{id}', 'PersonController@update')->name('update');
    Route::post('/search-list', 'PersonController@searchList')->name('search.list');
    Route::get('/family-tree/{id}', 'PersonController@familyTree')->name('family.tree');
    Route::get('/family-tree-json/{id}', 'PersonController@familyTreeJson')->name('family.tree.json');
});

Route::prefix('partner')->name('partner.')->middleware('auth', 'access.right:superadmin,admin,family_head')->group(function () {
    Route::get('/create', 'PartnerController@create')->name('create');
    Route::post('/store', 'PartnerController@store')->name('store');
    Route::get('/edit/{id}', 'PartnerController@edit')->name('edit');
    Route::put('/update/{id}', 'PartnerController@update')->name('update');
});

Route::prefix('zone')->name('zone.')->middleware('auth', 'access.right:superadmin,admin,family_head')->group(function () {
    Route::get('/provinces', 'ZoneController@provinces')->name('province');
    Route::get('/cities', 'ZoneController@cities')->name('city');
    Route::get('/districts', 'ZoneController@districts')->name('district');
    Route::get('/villages', 'ZoneController@villages')->name('village');
});
