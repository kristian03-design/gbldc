<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class MemberPasswordResetController extends Controller
{
    public function showForgot()
    {
        return view('Guest.MemberForgotPassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker('officialmembers')->sendResetLink([
            // Important: officialmembers email is encrypted; username is searchable
            'username' => (string) $request->input('email'),
        ]);

        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'forgot-password',
                'hypothesisId' => 'H-FORGOT-SEND',
                'location' => 'MemberPasswordResetController.php:sendResetLink',
                'message' => 'Forgot password sendResetLink result',
                'data' => [
                    'status' => (string) $status,
                    'ok' => $status === Password::RESET_LINK_SENT,
                ],
                'timestamp' => (int) (microtime(true) * 1000),
            ];
            @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {}
        // #endregion

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showReset(Request $request, string $token)
    {
        return view('Guest.MemberResetPassword', [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        $status = Password::broker('officialmembers')->reset(
            [
                'username' => (string) $request->input('email'),
                'password' => (string) $request->input('password'),
                'password_confirmation' => (string) $request->input('password_confirmation'),
                'token' => (string) $request->input('token'),
            ],
            function ($user, $password) {
                $user->password = (string) $password;
                $user->must_change_password = false;
                $user->save();
                Auth::guard('officialmember')->login($user);
            }
        );

        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'reset-password',
                'hypothesisId' => 'H-RESET-STATUS',
                'location' => 'MemberPasswordResetController.php:reset',
                'message' => 'Password reset result',
                'data' => [
                    'status' => (string) $status,
                    'ok' => $status === Password::PASSWORD_RESET,
                ],
                'timestamp' => (int) (microtime(true) * 1000),
            ];
            @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {}
        // #endregion

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('Member.Landing')->with('success', 'Password reset successfully.')
            : back()->withErrors(['email' => __($status)]);
    }
}

