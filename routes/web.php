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

Route::get('/import_excel', [ImportExcelController::class, 'index']);
Route::post('/import_excel/import', [ImportExcelController::class, 'import']);
Route::get('/export_excel', [ExportExcelController::class, 'export']);
