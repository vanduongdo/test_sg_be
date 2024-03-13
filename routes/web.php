<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ExportExcelController;

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

Route::get('/product-data', [ImportExcelController::class, 'index']);
Route::post('/import_excel/import', [ImportExcelController::class, 'import']);
Route::get('/download_sample_file', [ImportExcelController::class, 'download_file_sample']);
Route::get('/export_excel', [ExportExcelController::class, 'export']);
