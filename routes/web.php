<?php

use App\Events\MessageSent;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RedisController;
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
Auth::routes();

Route::get('/', function () {
    broadcast(new TestEvent());
    return view('welcome');
});

Route::get('/data', [RedisController::class, 'getEvents']);

Route::get('/chat', function() {
    return view('chat');
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/send-message', function (Request $request) {
    $name = Auth::user()->name;
    broadcast(new MessageSent($name, $request->message));
    return $request->message;
});
