<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ImageController::class, 'landing'])->name('landingpage');
Route::get('/Try', [ImageController::class, 'input'])->name('Try');
Route::post('/scrape', [ImageController::class, 'scrape'])->name('ImageScrape');
Route::post('/ColorShiftingUrl', [ImageController::class, 'storeByUrl'])->name('images.storeByUrl');
Route::post('/ColorShiftingFile', [ImageController::class, 'storeByFile'])->name('images.storeByFile');
Route::post('/DownloadImage', [ImageController::class, 'download'])->name('DownloadImage');
