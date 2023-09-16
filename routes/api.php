<?php

use Illuminate\Http\Request;
use App\Http\Controllers\InvoiceGeneratorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Create a new invoice
Route::post('invoice-create-api', [InvoiceGeneratorController::class, 'invoice_create_api']);
Route::post('invoice-create', [InvoiceGeneratorController::class, 'invoice_create']);
