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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Modules\APIFrontEnd\App\Models\Register;
use Modules\Dashboard\App\Models\userDetail;

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
        // Validate input
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'captcha' => 'null',
        ]);

        // Verify Turnstile token
        // $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        //     'secret' => env('TURNSTILE_SECRET'),
        //     'response' => $request->captcha,
        //     'remoteip' => $request->ip(),
        // ]);

        // $result = $response->json();
        // if (!isset($result['success']) || !$result['success']) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Captcha verification failed. Please try again.',
        //     ], 422);
        // }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);

        userDetail::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => 1,
            'profile' => null,
        ]);

        $user->assignRole('user');
        return response()->json([
            'status' => true,
            'message' => 'Register successfully',
            'user' => $user,
        ], 201);
    }

    // public function login(Request $request)
    // {

    //     try {
    //         $credentials = $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required',
    //         ]);

    //         $user = User::where('email', $request->email)->first();


    //         if (!$token = auth()->attempt($credentials)) {
    //             return response()->json([
    //                 'message' => 'Invalid credentials'
    //             ], 401);
    //         }

    //         // Generate 6-digit code
    //         // $code = rand(100000, 999999);
    //         // $user->verification_code = $code;
    //         // $user->verification_expires_at = Carbon::now()->addMinutes(5);
    //         // $user->save();

    //         // Send email
    //         Mail::to($user->email)->send(new VerificationCodeMail($code));

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'bearer',
    //             'user' => auth()->user(),
    //         ]);
    //     } catch (Exception $e) {
    //         return response($e->getMessage());
    //     }




    // }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        // generate token
        $token = Str::random(64);

        $user->update([
            'login_verify_token' => hash('sha256', $token),
            'login_token_expires_at' => now()->addMinutes(10),
        ]);

        // send email
        Mail::to($user->email)->send(
            new VerificationCodeMail($token)
        );

        return response()->json([
            'message' => 'Verification link sent to your email'
        ]);
    }


    public function verifyLogin(Request $request)
    {
        $user = User::where('login_verify_token', $request->token)
            // ->where('verification_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid or expired verification link'
            ], 401);
        }

        $user->update([
            'login_verify_token' => null,
            'verification_expires_at' => null,
        ]);

        $token = $user->createToken('login')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);

    }


}
