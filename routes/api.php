<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IceAndFireController;
use App\Http\Controllers\BookController;

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

Route::get('books',[IceAndFireController::class,'getBooks']);

Route::group(['prefix' => 'v1'], function () {

      Route::post('books', [BookController::class, 'store']);
      Route::get('books', [BookController::class, 'index']);
      Route::patch('books/{book_id}', [BookController::class, 'update']);
      Route::get('books/{book_id}', [BookController::class, 'show']);
      Route::delete('books/{book_id}', [BookController::class, 'destroy']);
  
});
