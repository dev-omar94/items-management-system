<?php

use App\Http\Controllers\ItemController;
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
    return redirect(route('item.create'));
});

Route::resource('item', ItemController::class)->except(['show', 'destroy', 'index', 'edit', 'update']);
Route::post('/item/select-item', [ItemController::class, 'selectItem'])->name('item.select');
Route::post('/item/unselect-item', [ItemController::class, 'unSelectItem'])->name('item.unselect');
