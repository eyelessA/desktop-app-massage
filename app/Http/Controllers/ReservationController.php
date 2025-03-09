<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationStoreRequest $request): void
    {
        $data = $request->validated();
        $therapist = Reservation::query()->create([
            'user_id' => Auth::id(),
            'therapist_id' => $data['therapist_id'],
            'duration' => $data['duration'],
            'massage_type' => $data['massage_type'],
            'time' => $data['time'],
        ]);
    }
}
