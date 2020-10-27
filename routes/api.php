<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rosurce APIs
Route::apiResource('user' , 'API\UserController');

Route::apiResource('books' , 'API\BooksController');

Route::apiResource('purchase' , 'API\PurchaseController');

Route::apiResource('sales' , 'API\SalesController');

Route::apiResource('categories' , 'API\CategoriesController');


//Get requests
Route::get('findUser', 'API\UserController@search');

Route::get('profile' ,'API\UserController@profile');
