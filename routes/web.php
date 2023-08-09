<?php

use Illuminate\Support\Facades\Route;
use \App\Jobs\SubscriptionCheckOutJob;
use \App\Services\PurchaseService;

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

Route::get('/test',function(){
    // here you can use the job class at the top and refer it here without the full namespace. Makes it cleaner. Same for the service
    SubscriptionCheckOutJob::dispatch(app()->make(PurchaseService::class));
});
