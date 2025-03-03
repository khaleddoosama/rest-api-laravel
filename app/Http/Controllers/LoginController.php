<?php
namespace App\Http\Controllers;

use App\Events\UserLogedIn;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            event(new UserLogedIn($user));

            $accessToken = $user->createToken('Access Token')->plainTextToken;
            return response()->json([
                'User'  => new UserResource($user),
                'Token' => $accessToken,
            ]);
        }
        return response()->json([
            'message' => 'the email or password not correct',
        ], 401);

    }
}
