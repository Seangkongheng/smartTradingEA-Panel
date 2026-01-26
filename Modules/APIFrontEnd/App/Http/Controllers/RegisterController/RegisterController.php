<?php

namespace Modules\APIFrontEnd\App\Http\Controllers\RegisterController;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginVerifyMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Modules\APIFrontEnd\App\Models\Register;
use Modules\Dashboard\App\Models\userDetail;
use Nwidart\Modules\Json;

class RegisterController extends Controller
{

    public function index()
    {
        return view('apifrontend::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apifrontend::create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function register(Request $request)
    {
        try {
            // ✅ Validate input
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'captcha' => 'required',
            ]);

            if ($request->filled('captcha')) {
                $response = Http::asForm()->post(
                    'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                    [
                        'secret' => env('TURNSTILE_SECRET'),
                        'response' => $request->captcha,
                        'remoteip' => $request->ip(),
                    ]
                );

                $result = $response->json();

                if (empty($result['success']) || $result['success'] !== true) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Captcha verification failed.',
                    ], 422);
                }
            }

            //Noted : Create user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => 1,
                'profile' => null,
            ]);

            // Noted : Assign default role
            $user->assignRole('user');

            return response()->json([
                'status' => true,
                'message' => 'Register successfully',
                'user' => $user,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }


    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required',

            ]);

            if ($request->filled('captcha')) {
                $response = Http::asForm()->post(
                    'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                    [
                        'secret' => env('TURNSTILE_SECRET'),
                        'response' => $request->captcha,
                        'remoteip' => $request->ip(),
                    ]
                );

                $result = $response->json();

                if (empty($result['success']) || $result['success'] !== true) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Captcha verification failed.',
                    ], 422);
                }
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Generate login verification token
            $loginToken = Str::uuid();

            $user->update([
                'login_verify_token' => $loginToken,
                'verification_expires_at' => Carbon::now('Asia/Phnom_Penh')->addMinutes(10),
            ]);

            $url = config('app.frontend_url')
                . "/verify-login?token={$loginToken}&user={$user->id}";

            Mail::to($user->email)->send(
                new VerificationCodeMail($url, $user->id)
            );

            return response()->json([
                'message' => 'Verification email sent'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }


    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'user' => 'required'
        ]);


        $user = User::where('id', $request->user)
            // ->where('login_verify_token', $request->token)
            // ->where('verification_expires_at', '>', Carbon::now('Asia/Phnom_Penh'))
            ->first();


        if (!$user) {
            return response()->json([
                'message' => 'Invalid or expired verification link'
            ], 401);
        }

        // Clear login verification
        $user->update([
            'login_verify_token' => null,
            'verification_expires_at' => null,
        ]);

        // Now issue access token
        $token = $user->createToken('login')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
            'message' => 'Login verified successfully'
        ]);
    }


    public function isVerify()
    {

    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'messages' => "Logout Successfull"
        ]);
    }


    public function username(Request $request)
    {
        $user = $request->user(); // better than Auth::user()

        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ]);
    }


}
