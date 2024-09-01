<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sitemap', [ApiController::class, 'sitemap'])->name('sitemap');
Route::get('/feed', [ApiController::class, 'feed'])->name('feed');
Route::get('/update-post', [ApiController::class, 'updatePost'])->name('updatePost');
