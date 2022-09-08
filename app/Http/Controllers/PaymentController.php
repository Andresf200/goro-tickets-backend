<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\TicketResource;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Payment $payment)
    {
        return PaymentResource::make($payment);
    }

    public function index()
    {
        return PaymentResource::collection(Payment::all());
    }

    public function store(PaymentStoreRequest $request): PaymentResource
    {
        $ticket = Ticket::findOrFail($request->validated('id_ticket'));
        $ticket->update(['remaining_amount' => $ticket->remaining_amount - $request->validated('mount') ]);
        return PaymentResource::make(Payment::create($request->validated()));
    }

    public function update(PaymentUpdateRequest $request, Payment $payment): PaymentResource|\Illuminate\Http\JsonResponse
    {
        $payment->fill($request->validated());
        if($payment->isClean()){
            return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }
        $payment->save();
        return  PaymentResource::make($payment);
    }

    public function destroy(Payment $payment): PaymentResource
    {
        $payment->delete();
        return  PaymentResource::make($payment);
    }
}
