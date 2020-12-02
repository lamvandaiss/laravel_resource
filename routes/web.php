<?php
use App\Http\Controllers\ResourceController;
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
Route::get('/', [ResourceController::class, 'index']);
Route::get('/resource', [ResourceController::class, 'formResource']);
Route::post('/resource', [ResourceController::class, 'store']);
Route::get('/category/{id}', [ResourceController::class, 'detailCategory']);
Route::get('/search', [ResourceController::class, 'searchByTask']);