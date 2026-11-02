<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request): RedirectResponse
    {
        Reservation::create($request->validated());

        return redirect()
            ->to(route('book').'#booking-form')
            ->with('booked', $request->string('name')->before(' ')->toString());
    }
}
