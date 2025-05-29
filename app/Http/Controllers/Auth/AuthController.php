<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    // Show services page
    public function showServices()
    {
        return view('auth.services');
    }
    
    // Handle registration form submission
    public function register(Request $request)
    {
        // Validate the request with form field names
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'terms' => 'required|accepted',
        ], [
            'terms.required' => 'You must accept the terms and conditions',
            'terms.accepted' => 'You must accept the terms and conditions',
            'password.confirmed' => 'The passwords do not match',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user with form field names
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'client',
        ]);

        // Send email verification notification
        event(new Registered($user));

        // Redirect to login with success message
        return redirect()->route('auth.login')
            ->with('status', 'Registration successful! Please check your email to verify your account before logging in.');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if login is email or account number
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_number';

        // Attempt to authenticate
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            
            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                
                // Resend verification email if requested
                if ($request->resend_verification) {
                    $user->sendEmailVerificationNotification();
                    return redirect()->route('verification.notice')
                        ->with('status', 'A new verification link has been sent to your email address.');
                }
                
                return redirect()->route('verification.notice')
                    ->with('warning', 'You need to verify your email address before you can log in.');
            }
            
            // Redirect based on user role
            switch ($user->role) {
                case 'staff':
                    return redirect()->route('staff.dashboard');
                case 'doctor':
                    return redirect()->route('doctor.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                default:
                    return redirect()->route('client.dashboard');
            }
        }

        // Authentication failed
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('login', 'remember'));
    }
    
    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}