<?php
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\FileController;
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
Route::get('/', [ResourceController::class, 'allResource']);
Route::get('/resource', [ResourceController::class, 'formResource']);
Route::post('/resource', [ResourceController::class, 'store']);
Route::get('/category/{id}', [ResourceController::class, 'detailCategory']);
Route::get('/search', [ResourceController::class, 'searchByTag']);
Route::post('/file/resource', [FileController::class, 'singleUpload']);
Route::get('/detail-resource/{id}', [ResourceController::class, 'showResource'])->name('showResource');
Route::post('/update-resource', [ResourceController::class, 'update']);
