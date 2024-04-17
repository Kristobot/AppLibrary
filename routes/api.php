<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function(){

    Route::post('/register',[RegisteredUserController::class,'register']);
    Route::get('/login',[AuthenticatedController::class,'login']);
    Route::delete('/logout',[AuthenticatedController::class,'logout'])->middleware('auth:sanctum');

});

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::group(['prefix' => 'book'], function(){

        Route::get('/',[BookController::class,'index'])->name('books.index');
        Route::post('/', [BookController::class,'store'])->name('books.create');
        Route::get('/{book}',[BookController::class,'show'])->name('books.show');
        Route::match(['put','patch'], '/{book}',[BookController::class,'update'])->name('books.update');
        Route::delete('/{book}',[BookController::class,'destroy'])->name('books.delete');

    });

    Route::group(['prefix' => 'author'], function(){

        Route::get('/',[AuthorController::class,'index'])->name('authors.index');
        Route::post('/', [AuthorController::class,'store'])->name('authors.create');
        Route::get('/{author}',[AuthorController::class,'show'])->name('authors.show');
        Route::match(['put','patch'], '/{author}',[AuthorController::class,'update'])->name('authors.update');
        Route::delete('/{author}',[AuthorController::class,'destroy'])->name('authors.delete');

    });

    Route::group(['prefix' => 'copy'], function(){

        Route::get('/',[CopyController::class,'index'])->name('copies.index');
        Route::post('/', [CopyController::class,'store'])->name('copies.create');
        Route::get('/{copy}',[CopyController::class,'show'])->name('copies.show');
        Route::delete('/{copy}',[CopyController::class,'destroy'])->name('copies.delete');

    });

    Route::group(['prefix' => 'loan'], function(){

        Route::get('/',[LoanController::class,'index'])->name('loans.index');
        Route::post('/', [LoanController::class,'store'])->name('loans.create');
        Route::get('/{loan}',[LoanController::class,'show'])->name('loans.show');
        Route::match(['put','patch'], '/{loan}',[LoanController::class,'update'])->name('loans.update');
        Route::delete('/{loan}',[LoanController::class,'destroy'])->name('loans.delete');

    });
});
