<?php

namespace UserModule\app\Http\Controllers\Api;

use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use UserModule\App\Http\Requests\Auth\LoginRequest;
use UserModule\App\Http\Requests\UserRequest;
use UserModule\app\Models\User;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $password = Hash::make($request->post('password'));
        $request->merge([
            'password' => $password,
        ]);

        $user = User::create($request->all());

//        $token = $user->createToken('myapptoken')->plainTextToken;
        $tokens = $this->createTokens($user);
        $response = [
            'user' => $user,
            'token' => $tokens,
        ];

        return response($response, 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad Credentials'
            ], 401);
        }
        if ($user->tokens() != null) {
            $user->tokens()->delete();
        }
//        $token = $user->createToken('myapptoken', ['*'], Carbon::now()->addMinutes(1))->plainTextToken;
        $tokens = $this->createTokens($user);
        $response = [
            'user' => $user,
            'tokens' => $tokens,
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(
                ['success' => 'Check your email to reset password']
            )
            : response()->json(
                ['failed' => 'There is an error occur']
            );
    }

    public function refresh()
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return $this->createTokens($user);
    }

    public function createTokens($user): JsonResponse
    {
        $access_token = $user->createToken('access-token', [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.token_expiration')));

        $refresh_token = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.refresh_expiration')));

        return response()->json([
            'token' => $access_token->plainTextToken,
            'refresh_token' => $refresh_token->plainTextToken,
        ]);
    }
}
