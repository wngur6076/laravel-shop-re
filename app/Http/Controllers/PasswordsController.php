<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\PasswordRemindCreated;
use Illuminate\Support\Facades\Hash;

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

        event(new PasswordRemindCreated($user, $code));

        return response()->json([
            'success' => 'reset_email_sent'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8|string',
        ]);
        $code = $request->input('code');
        $user = \DB::table('password_resets')->whereToken($code)->first();

        if (! $user) {
            return response()->json([
                'error' => 'url_error',
                'message' => '사용한 코드입니다.'
            ], 401);
        }

        User::whereEmail($user->email)->first()->update([
            'password' => Hash::make($request->input('password'))
        ]);
        \DB::table('password_resets')->whereToken($code)->delete();

        return response()->json([
            'success' => 'success',
            'message' => '비밀번호를 바꾸었습니다. 새로운 비밀번호로 로그인 하세요.',
        ], 200);
    }
}
