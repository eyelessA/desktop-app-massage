<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'count' => User::all()->count()
        ]);
    }

    public function numberOfUsersRegisteredToday(): JsonResponse
    {
        $count = User::query()->whereDate('created_at', today())->count();
        return response()->json(['count' => $count]);
    }
}
