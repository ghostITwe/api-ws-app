<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse|string
    {
        try {
            $credentials = $request->validate([
                'login' => 'required|string',
                'password' => 'required|string'
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('login_token', ['*'], (new DateTime())->modify('+10 day'))
                    ->plainTextToken;

                return response()->json([
                    'token' => $token
                ], Response::HTTP_OK);
            }

            return response()->json([
                'error' => 'Unauthenticated'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function register(Request $request): JsonResponse|string
    {
        try {
            $data = $request->validate([
                'email' => 'required|string|email|unique:users',
                'lastname' => 'required|string',
                'name' => 'required|string',
                'patronymic' => 'required|string',
                'phone' => 'required|string|max:11',
                'role' => 'required',
                'study_group' => 'required|string',
                'password' => 'required|string|confirmed|min:8'
            ]);

            $user = User::create([
                'email' => $data['email'],
                'lastname' => $data['lastname'],
                'name' => $data['name'],
                'patronymic' => $data['patronymic'],
                'phone' => $data['phone'],
                'role' => $data['role'],
                'study_group' => $data['study_group'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $user->createToken('registration_token', ['*'], (new DateTime())->modify('+10 day'))
                ->plainTextToken;

            return response()->json([
                'token' => $token
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
