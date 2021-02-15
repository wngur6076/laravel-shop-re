<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function store($provider)
    {
        $user = \Socialite::driver($provider)->stateless()->user();

        $authUser = $this->findOrCreateUser($user);

        if ($token = Auth::guard()->login($authUser)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    private function findOrCreateUser($socialLiteUser)
    {
        $user = (User::whereEmail($socialLiteUser->email)->first())
            ?: User::create([
                'name'  => 'unknown',
                'email' => $socialLiteUser->email,
            ]);

        return $user;
    }
}
