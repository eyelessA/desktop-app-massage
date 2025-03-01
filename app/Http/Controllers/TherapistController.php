<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Http\JsonResponse;

class TherapistController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Therapist::query()->where('rating', '>=', 3)->paginate(6)
        );
    }
}
