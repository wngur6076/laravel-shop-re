<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'user']]);
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password'  => 'required|min:8|string', //confirmed
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $confirmCode = \Str::random(60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_code' => $confirmCode,
        ]);

        // 가입확인 메일 보내는 이벤트
        event(new UserCreated($user));

        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (! $token = $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'login_error', 'message' => '입력을 다시 확인해주세요.'], 401);
        }
        if (! Auth::user()->activated) {
            return response()->json(['error' => 'confirm_error', 'message' => '메일을 다시 확인해주세요.'], 401);
        }

        return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out Successfully.'
        ], 200);
    }

    public function confirm(Request $request)
    {
        $user = User::whereConfirmCode($request->input('code'))->first();

        if(! $user) {
            return response()->json(['error' => 'code_error'], 401);
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        if ($token = $this->guard()->login($user)) {
            return response()->json(['status' => 'success', 'user' => $user], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
