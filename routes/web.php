<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontEndController;

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

/* Route::any('/', function () {
    return view('home');
}); */

Route::any('/', [FrontEndController::class, 'index'])->name('/');
Route::post('/search', [FrontEndController::class, 'search'])->name('search');
Route::post('/subscribe', [FrontEndController::class, 'subscribe'])->name('subscribe');
Route::get('/category/{url}', [FrontEndController::class, 'category'])->name('category');
Route::get('/post/{url}', [FrontEndController::class, 'blog'])->name('blog');
Route::get('/questions', [FrontEndController::class, 'questions'])->name('questions');
Route::get('/question/{url}', [FrontEndController::class, 'question'])->name('question');
Route::get('/author/{url}', [FrontEndController::class, 'author'])->name('author');
Route::post('/comment', [FrontEndController::class, 'comment'])->name('comment');
Route::get('/rss', [FrontEndController::class, 'feed_rss']);
Route::get('/feed', [FrontEndController::class, 'feed_rss']);

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function(){

    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function() {
    
            Route::resource('/blog', BlogController::class);
            Route::resource('/questions', QuestionController::class);
            Route::resource('/category', CategoryController::class);
            Route::resource('/comment', CommentController::class);
            Route::resource('/image', ImageController::class);
            Route::resource('/profile', ProfileController::class);
        });
    });

    Route::middleware(['user'])->group(function () {
        Route::prefix('user')->group(function() {
    
            // 
        });
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//Logout user direct:
Route::get('/logout', function() {
    Session::flush();
    Auth::logout();
    return '<h1>Logout User Direct</h1>';
});

//Admin url:
Route::get('/admin', function() {
    return redirect('home');
});

//User url:
Route::get('/user', function() {
    return redirect('home');
});

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
