<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
// Route::controller('datatables', 'DatatablesController', [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);
Route::get('users', ['uses'=>'App\Http\Controllers\UserController@index', 'as'=>'users.index']);

Route::delete('delete', [UserController::class, 'delete'])->name('delete');

Route::post('update', [UserController::class, 'update'])->name('update');