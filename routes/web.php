<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignsController;

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
    return view('welcome');
});


Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');


// Route::get('/dashboard', 'DashboardController@index');
Route::get('/campaigns', [CampaignsController::class, 'index']);

Route::get('/campaigns/{id}', [CampaignsController::class, 'show']);

Route::get('/campaigns/{id}/delete', [CampaignsController::class, 'destroy']);

Route::post('/campaigns/delete', [CampaignsController::class, 'newdestroy']);

Route::get('/campaigns/{id}/edit', [CampaignsController::class, 'edit']);

// Route::get('/dashboard', [CampaignsController::class, 'dashboard']);

Route::get('/create', [CampaignsController::class, 'create']);

Route::post('/create', [CampaignsController::class, 'store']);

Route::post('/update', [CampaignsController::class, 'newupdate']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
