<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $response = null;
        $response_code = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($user) {
            $response = $user;
            $response_code = Response::HTTP_CREATED;
        }

        return response()->json($response, $response_code);
    }
}
