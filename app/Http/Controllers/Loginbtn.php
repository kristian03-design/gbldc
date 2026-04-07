<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\OTP;

class Loginbtn extends Controller
{
    public function Login(Request $request)
    {
        // Validate the incoming request credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if (Auth::guard('admin')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            
            $user = Auth::guard('admin')->user();
            if ($user->status === 'Deactivated') {
                Auth::guard('admin')->logout(); 
                return redirect()->back()->withInput($request->except('password'))->with('error', 'Your account has been deactivated.');
            }

            // Regenerate session to prevent session fixation attacks and "Page Expired" issues
            $request->session()->regenerate();

            $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);

            // #region agent log
            file_put_contents(
                base_path('debug-f9f41c.log'),
                json_encode([
                    'sessionId' => 'f9f41c',
                    'runId' => 'otp-pre',
                    'hypothesisId' => 'OTP1',
                    'location' => 'Loginbtn.php:35',
                    'message' => 'About to send OTP email',
                    'data' => [
                        'userId' => $user->id ?? null,
                        'email' => $user->email ?? null,
                    ],
                    'timestamp' => (int) (microtime(true) * 1000),
                ]) . PHP_EOL,
                FILE_APPEND
            );
            // #endregion

            try {
                Mail::to($user->email)->send(new OTP($OTP, $user->full_name, 'admin'));
            } catch (\Exception $e) {
                // #region agent log
                file_put_contents(
                    base_path('debug-f9f41c.log'),
                    json_encode([
                        'sessionId' => 'f9f41c',
                        'runId' => 'otp-error',
                        'hypothesisId' => 'OTP1',
                        'location' => 'Loginbtn.php:52',
                        'message' => 'Failed to send OTP email exception',
                        'data' => [
                            'exceptionClass' => get_class($e),
                            'exceptionMessage' => $e->getMessage(),
                            'trace' => $e->getTraceAsString(),
                        ],
                        'timestamp' => (int) (microtime(true) * 1000),
                    ]) . PHP_EOL,
                    FILE_APPEND
                );
                // #endregion

                return back()->withInput($request->except('password'))->with('error', 'Failed to send OTP email. Please try again.');
            }

            $encryptedOTP = Crypt::encrypt($OTP);
            session([
                'encryptedOTP' => $encryptedOTP,
                'email' => $user->email,
                'user' => $user,
            ]);

            return redirect()->route('Otp.Page');
        }
        return back()->withInput($request->except('password'))->with('error', 'Invalid email or password.');
    }
}
