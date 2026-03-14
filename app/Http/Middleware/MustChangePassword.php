<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustChangePassword
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('officialmember')->user();

        if ($user && ($user->must_change_password ?? false)) {
            $routeName = $request->route()?->getName();
            $path = '/' . ltrim($request->path(), '/');

            $allowedNames = [
                'Member.Password.Set',
                'Member.Password.Set.Save',
                'Member.Logout',
                'Member.ForgotPassword',
                'Member.ForgotPassword.Send',
                'Member.ResetPassword',
                'Member.ResetPassword.Save',
            ];

            if (!in_array($routeName, $allowedNames, true) && !str_starts_with($path, '/Member-Set-Password')) {
                // #region agent log
                try {
                    $payload = [
                        'sessionId' => '4b0db3',
                        'runId' => 'must-change-password',
                        'hypothesisId' => 'H-MIDDLEWARE-REDIRECT',
                        'location' => 'MustChangePassword.php:handle',
                        'message' => 'Redirecting member to set password',
                        'data' => [
                            'routeName' => $routeName,
                            'path' => $path,
                            'must_change_password' => true,
                        ],
                        'timestamp' => (int) (microtime(true) * 1000),
                    ];
                    @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
                } catch (\Throwable $e) {}
                // #endregion

                return redirect()->route('Member.Password.Set');
            }
        }

        return $next($request);
    }
}

