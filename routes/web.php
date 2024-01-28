<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaLikeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // topUsers
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');
Route::get('/admin', [AdminDashboardController::class,'index'])->middleware(['auth','can:admin'])->name('admin.dashboard');
Route::get('/lang/{lang}',function($lang){
    app()->setLocale($lang);
    session()->put('locale',$lang);
    return redirect()->route('dashboard');

}) -> name('lang');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.', 'middleware' => ['auth']], function () {

    Route::post('', [IdeaController::class, 'store'])->name('store');
    Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware'=>['auth']], function(){
        Route::delete('{idea}', [IdeaController::class, 'destroy'])
        ->name('destroy');

    Route::get('{idea}/edit', [IdeaController::class, 'edit'])
        ->name('edit');

    Route::put('{idea}', [IdeaController::class, 'update'])
        ->name('update');

    Route::post('{idea}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    });

});
Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only('edit','update')->middleware('auth');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/profile',[UserController::class,'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow',[FollowerController::class, 'follow'])->middleware('auth')->name('user.follow');
Route::post('users/{user}/unfollow',[FollowerController::class, 'unfollow'])->middleware('auth')->name('user.unfollow');

Route::post('ideas/{idea}/like',[IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike',[IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');


