<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Public Routes
Route::get('/comments', [CommentController::class, 'comments']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'articles']);


Route::prefix('v1')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('signup', [AuthController::class, 'signup'])->name('signup');
        Route::post('signin', [AuthController::class, 'signin'])->name('signin');
        Route::post('signout', [AuthController::class, 'signout'])->name('signout');
    });
});

Route::get('/articles/{article}', [ArticleController::class, 'showArticle']);


// Private Routes
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('/articles', [ArticleController::class, 'createArticle'])->name('createArticle');
    Route::put('/articles/{id}', [ArticleController::class, 'updateArticle'])->name('updateArticle');
    Route::delete('/articles/{id}', [ArticleController::class, 'deleteArticle'])->name('deleteArticle');
});

Route::get('/articles/{id}', [ArticleController::class, 'showArticle']);
// Route::post('/articles', [ArticleController::class, 'createArticle']);

