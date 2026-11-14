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
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Display the authentication portal in login mode.
     */
    public function showLogin(): View
    {
        return view('home', [
            'authenticatedUser' => Auth::user(),
            'initialMode' => 'login',
        ]);
    }

    /**
     * Display the authentication portal in register mode.
     */
    public function showRegister(): View
    {
        return view('home', [
            'authenticatedUser' => Auth::user(),
            'initialMode' => 'register',
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

        return redirect()->route('login')
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
            RateLimiter::hit($throttleKey, 300);

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

        $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('home');

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Signed in successfully.',
                'username' => $user->name,
                'redirect_url' => $redirectUrl,
            ]);
        }

        return redirect()->to($redirectUrl)->with('toast_success', 'Signed in successfully.');
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
                'redirect_url' => route('home'),
            ]);
        }

        return redirect()->route('home')->with('toast_info', 'Signed out.');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')
                ->with('toast_error', 'Google Sign-In is not configured yet. Please configure GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET in the environment.');
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->with('toast_error', 'Could not initiate Google authentication: ' . $e->getMessage());
        }
    }

    /**
     * Obtain the user information from Google and authenticate.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')
                ->with('toast_error', 'Google Sign-In is not configured yet.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->with('toast_error', 'Google authentication was cancelled or failed.');
        }

        if (! $googleUser || empty($googleUser->getEmail())) {
            return redirect()->route('login')
                ->with('toast_error', 'Could not retrieve verified email from Google.');
        }

        $email = Str::lower($googleUser->getEmail());

        // Find existing user by google_id or email (including soft-deleted accounts)
        $user = User::withTrashed()
            ->where(function ($query) use ($googleUser, $email) {
                $query->where('google_id', (string) $googleUser->getId())
                    ->orWhere('email', $email);
            })
            ->first();

        if ($user && $user->trashed()) {
            return redirect()->route('login')
                ->with('toast_error', 'Your account has been deactivated. Please contact support.');
        }

        if ($user) {
            $user->update([
                'google_id' => $user->google_id ?: (string) $googleUser->getId(),
                'avatar' => $googleUser->getAvatar() ?: $user->avatar,
            ]);
        } else {
            // Build unique, clean username
            $rawName = $googleUser->getName() ?: explode('@', $email)[0];
            $cleanBase = preg_replace('/[^a-zA-Z0-9_]/', '', Str::slug($rawName, '_')) ?: 'user';
            $cleanBase = Str::substr($cleanBase, 0, 16);
            $username = $cleanBase;
            $counter = 1;
            while (User::withTrashed()->where('name', $username)->exists()) {
                $username = Str::substr($cleanBase, 0, 14) . $counter;
                $counter++;
            }

            $user = User::create([
                'name' => $username,
                'email' => $email,
                'google_id' => (string) $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('home');

        return redirect()->intended($redirectUrl)
            ->with('toast_success', 'Successfully signed in with Google as ' . $user->name . '.');
    }
}
