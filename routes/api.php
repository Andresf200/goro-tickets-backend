<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientsDeletedController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SellerClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellersDeletedController;
use App\Http\Controllers\TicketClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketPaymentController;
use App\Http\Controllers\TicketsDeletedController;
use App\Http\Controllers\TicketSellerController;
use App\Http\Controllers\UserDeletedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::apiResource('clients',ClientController::class)->names('clients');
    Route::post('client/identifier',[ClientController::class,'showIdentifier'])->name('client_identifier');

    Route::apiResource('sellers',SellerController::class)->names('sellers');
    Route::post('seller/identifier',[SellerController::class,'showIdentifier'])->name('seller_identifier');

    Route::apiResource('tickets',TicketController::class)->names('tickets');
    Route::post('ticket/num',[TicketController::class,'showNumTicket'])->name('ticket_num');

    Route::apiResource('payments',PaymentController::class)->names('payments');

    Route::post('tickets/search/client',[TicketClientController::class,'index'])->name('ticket_search_client');
    Route::post('tickets/search/seller',[TicketSellerController::class,'index'])->name('ticket_search_seller');

    Route::get('client/tickets/{client}',[TicketClientController::class,'show'])->name('client_tickets');
    Route::get('seller/tickets/{seller}',[TicketSellerController::class,'show'])->name('seller_tickets');
    Route::get('ticket/payments/{ticket}',[TicketPaymentController::class,'show'])->name('ticket_payments');

    Route::get('seller/clients/{seller}',[SellerClientController::class,'show'])->name('seller_clients');

    Route::delete('ticekt/client/delete/{ticket}',[TicketClientController::class,'destroy'])->name('client_tickets');

    Route::delete('logout',[AuthController::class,'destroy'])->name('logout');


    Route::apiResource('clientsDeleted',ClientsDeletedController::class)->names('clients.deleted')
    ->only('show','index');

    Route::apiResource('sellersDeleted',SellersDeletedController::class)->names('sellers.deleted')
        ->only('show','index');

    Route::apiResource('ticketsDeleted',TicketsDeletedController::class)->names('sellers.deleted')
        ->only('show','index');
});

Route::post('login',[AuthController::class,'store'])->name('login');


