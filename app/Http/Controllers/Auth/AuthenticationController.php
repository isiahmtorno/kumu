<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    private const FAILED_MESSAGE = 'Incorrect email or password.';
    private const LOGOUT_MESSAGE = 'Successful logged out.';

    public function login(Request $request): JsonResponse
    {
        $params = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($params)) {
            $user = Auth::user();
            $user->revokeAccessToken();
            $access_token = $user->generateToken();

            return response()->json(['access_token' => $access_token]);
        }

        return response()->json(self::FAILED_MESSAGE, Response::HTTP_FORBIDDEN);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->revokeAccessToken();

        return response()->json(self::LOGOUT_MESSAGE);
    }
}
