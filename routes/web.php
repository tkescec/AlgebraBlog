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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

/*############ BEGIN ADMIN ROUTES ############*/
Route::prefix('admin')->group(function () {
  // Dashboard routes
  Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  // Post routes
  Route::resource('posts', 'Admin\PostController');
});
/*############# END ADMIN ROUTES #############*/












