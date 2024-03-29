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

        Route::get('/',[BookController::class,'index'])->can('viewAny','App\Models\Book');
        Route::post('/', [BookController::class,'store'])->can('create', 'App\Models\Book');
        Route::get('/{book}',[BookController::class,'show'])->can('view','book');
        Route::match(['put','patch'], '/{book}',[BookController::class,'update'])->can('update','book');
        Route::delete('/{book}',[BookController::class,'destroy'])->can('delete','book');

    });

    Route::group(['prefix' => 'author'], function(){

        Route::get('/',[AuthorController::class,'index'])->can('viewAny','App\Models\author');
        Route::post('/', [AuthorController::class,'store'])->can('create', 'App\Models\author');
        Route::get('/{author}',[AuthorController::class,'show'])->can('view','author');
        Route::match(['put','patch'], '/{author}',[AuthorController::class,'update'])->can('update','author');
        Route::delete('/{author}',[AuthorController::class,'destroy'])->can('delete','author');

    });

    Route::group(['prefix' => 'copy'], function(){

        Route::get('/',[CopyController::class,'index'])->can('viewAny','App\Models\Copy');
        Route::post('/', [CopyController::class,'store'])->can('create', 'App\Models\Copy');
        Route::get('/{copy}',[CopyController::class,'show'])->can('view','copy');
        Route::delete('/{copy}',[CopyController::class,'destroy'])->can('delete','copy');

    });

    Route::group(['prefix' => 'loan'], function(){

        Route::get('/',[LoanController::class,'index'])->can('viewAny','App\Models\Loan');
        Route::post('/', [LoanController::class,'store'])->can('create', 'App\Models\Loan');
        Route::get('/{loan}',[LoanController::class,'show'])->can('view','loan');
        Route::match(['put','patch'], '/{loan}',[LoanController::class,'update'])->can('update','loan');
        Route::delete('/{loan}',[LoanController::class,'destroy'])->can('delete','loan');

    });
});
