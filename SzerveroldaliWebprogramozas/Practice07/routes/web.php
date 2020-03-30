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

/*Route::get('/', function () {
    return view('home', ['name' => 'James']);
});*/

// Az útvonalakat az alábbi paranccsal tudod kilistázni:
//  php artisan route:list

Route::redirect('/', '/shopping-lists');

// Shopping lists
Route::get( '/shopping-lists',                      'ShoppingListController@indexAll'   )    ->name('shopping-lists');
Route::get( '/shopping-list/{id}',                  'ShoppingListController@indexItem'  )    ->name('shopping-list');

Route::get( '/add-shopping-list',                   'ShoppingListController@indexAdd'   )     ->name('add-shopping-list');
Route::post('/add-shopping-list',                   'ShoppingListController@store'      )     ->name('store-shopping-list');

// List items
Route::get( '/shopping-list/{id}/add-list-item',    'ListItemController@indexAdd'       )     ->name('add-list-item');
Route::post('/shopping-list/{id}/add-list-item',    'ListItemController@store'          )     ->name('store-list-item');
