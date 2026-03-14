<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRule;

class MemberPasswordSetupController extends Controller
{
    public function show()
    {
        return view('Members.SetPassword');
    }

    public function save(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        $user = Auth::guard('officialmember')->user();
        if (!$user) {
            return redirect()->route('Member.Login')->with('error', 'Session expired. Please login again.');
        }

        $user->password = (string) $request->input('password');
        $user->must_change_password = false;
        $user->save();

        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'set-password',
                'hypothesisId' => 'H-SET-PASSWORD',
                'location' => 'MemberPasswordSetupController.php:save',
                'message' => 'Member set new password',
                'data' => [
                    'updated' => true,
                    'must_change_password' => (bool) $user->must_change_password,
                ],
                'timestamp' => (int) (microtime(true) * 1000),
            ];
            @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {}
        // #endregion

        return redirect()->route('Member.Landing')->with('success', 'Password updated successfully.');
    }
}

