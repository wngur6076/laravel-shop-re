<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\PasswordRemindCreated;

class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postRemind(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|string|max:255|exists:users']);

        $user = User::whereEmail($request->input('email'))->first();
        $code = \Str::random(64);

        \DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $code,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        event(new \App\Events\PasswordRemindCreated($user, $code));

        return response()->json([
            'success' => 'reset_email_sent'
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
