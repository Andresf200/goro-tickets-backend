<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TicketClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketSellerController;
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

Route::post('tickets/search/client',[TicketClientController::class,'index'])->name('ticket_search_client');
Route::get('client/tickets/{client}',[TicketClientController::class,'show'])->name('client_tickets');


Route::post('tickets/search/seller',[TicketSellerController::class,'index'])->name('ticket_search_seller');
Route::get('seller/tickets/{seller}',[TicketSellerController::class,'show'])->name('seller_tickets');

