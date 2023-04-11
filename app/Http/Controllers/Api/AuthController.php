<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\{Http\JsonResponse, Http\Request, Support\Facades\Auth, Support\Facades\Hash};
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): array|string
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('login_token', ['*'], (new DateTime())->modify('+10 day'))
                    ->plainTextToken;

                return [
                    'token' => $token
                ];
            }

            return response()->json([
                'error' => 'Unauthenticated'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function register(Request $request): array|string
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

            return [
                'token' => $token
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request): array
    {
        $request->user()->currentAccessToken()->delete();

        return [];
    }
}
