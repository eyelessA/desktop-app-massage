<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class TherapistController extends Controller
{
    public function index(): Collection
    {
        return Therapist::all();
    }
    public function bestTherapists(): JsonResponse
    {
        return response()->json(
            Therapist::query()->where('rating', '>=', 3)->paginate(6)
        );
    }
}
