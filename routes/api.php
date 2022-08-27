<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TicketClientController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('clients',ClientController::class)->names('clients');
Route::apiResource('sellers',SellerController::class)->names('sellers');
Route::apiResource('tickets',TicketController::class)->names('tickets')
    ->except('destroy');
Route::apiResource('payments',PaymentController::class)->names('payments');

Route::post('tickets/search/client',[TicketClientController::class,'show'])->name('ticket_search_client');
Route::get('client/tickets',[TicketClientController::class,'index'])->name('client_tickets');

