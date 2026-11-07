<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the authentication view.
     */
    public function show(): View
    {
        return view('home', [
            'authenticatedUser' => Auth::user(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9_]+$/', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ], [
            'username.regex' => 'Username may only contain letters, numbers, and underscores.',
            'username.unique' => 'Username is already taken.',
            'email.unique' => 'An account with this email already exists.',
        ]);

        $user = User::create([
            'name' => $validated['username'],
            'email' => Str::lower($validated['email']),
            'password' => $validated['password'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Account created successfully. Please sign in.',
                'username' => $user->name,
            ], 201);
        }

        return redirect()->route('home')
            ->with('toast_success', 'Account created successfully. Please sign in.')
            ->with('registered_username', $user->name);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = Str::transliterate(Str::lower($validated['username']).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $message = "Too many failed attempts. Please try again in {$seconds}s.";

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'locked',
                    'message' => $message,
                    'retry_after' => $seconds,
                ], 429);
            }

            return back()->withErrors(['username' => $message])->onlyInput('username');
        }

        $identifier = $validated['username'];
        $user = User::query()
            ->whereRaw('LOWER(name) = ?', [Str::lower($identifier)])
            ->orWhereRaw('LOWER(email) = ?', [Str::lower($identifier)])
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            RateLimiter::hit($throttleKey, 30);

            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                $seconds = RateLimiter::availableIn($throttleKey);

                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'locked',
                        'message' => "Too many failed attempts. Locked for {$seconds}s.",
                        'retry_after' => $seconds,
                    ], 429);
                }
            }

            $errorMessage = 'Invalid username or password.';

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errorMessage,
                ], 422);
            }

            return back()->withErrors(['username' => $errorMessage])->onlyInput('username');
        }

        RateLimiter::clear($throttleKey);
        Auth::login($user);
        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Signed in successfully.',
                'username' => $user->name,
            ]);
        }

        return redirect()->route('home')->with('toast_success', 'Signed in successfully.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Signed out.',
            ]);
        }

        return redirect()->route('home')->with('toast_info', 'Signed out.');
    }
}
