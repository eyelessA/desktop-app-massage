<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class TherapistController extends Controller
{
    public function index(): Collection
    {
        return Therapist::all();
    }

    public function bestTherapists(): JsonResponse
    {
        return response()->json(
            Therapist::query()->where('rating', '>=', 4)->paginate(6)
        );
    }

    public function show(int $id): Response
    {
        $therapist = Therapist::query()->findOrFail($id);
        return Inertia::render('TherapistShow', ['therapist' => $therapist]);
    }
}
