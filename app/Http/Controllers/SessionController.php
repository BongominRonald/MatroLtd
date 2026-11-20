<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Get current session status and CSRF token.
     */
    public function status(Request $request): JsonResponse
    {
        $isAuth = Auth::check();
        $lifetimeMinutes = config('session.lifetime', 120);

        return response()->json([
            'authenticated' => $isAuth,
            'user' => $isAuth ? [
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role,
            ] : null,
            'csrf_token' => csrf_token(),
            'lifetime_minutes' => $lifetimeMinutes,
            'expires_in_seconds' => $lifetimeMinutes * 60,
        ]);
    }

    /**
     * Keep the session alive and return a refreshed CSRF token.
     */
    public function keepAlive(Request $request): JsonResponse
    {
        $request->session()->put('last_activity_ping', now()->timestamp);

        return response()->json([
            'status' => 'success',
            'message' => 'Session extended successfully.',
            'authenticated' => Auth::check(),
            'csrf_token' => csrf_token(),
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * List all active browser/device sessions for the authenticated user.
     */
    public function devices(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $currentSessionId = $request->session()->getId();

        $rawSessions = DB::table('sessions')
            ->where('user_id', $userId)
            ->orderByDesc('last_activity')
            ->get();

        $sessions = $rawSessions->map(function ($s) use ($currentSessionId) {
            $deviceInfo = self::parseUserAgent($s->user_agent);

            return [
                'id' => substr($s->id, 0, 8) . '...',
                'ip_address' => $s->ip_address ?: 'Unknown IP',
                'is_current_device' => ($s->id === $currentSessionId),
                'device_type' => $deviceInfo['device_type'],
                'browser' => $deviceInfo['browser'],
                'platform' => $deviceInfo['platform'],
                'last_active' => Carbon::createFromTimestamp($s->last_activity)->diffForHumans(),
                'last_active_timestamp' => $s->last_activity,
            ];
        });

        return response()->json([
            'status' => 'success',
            'total_active' => $sessions->count(),
            'current_session_id' => substr($currentSessionId, 0, 8) . '...',
            'sessions' => $sessions,
        ]);
    }

    /**
     * Log out all other browser sessions for the authenticated user.
     */
    public function logoutOtherDevices(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password does not match your current account credentials.'],
            ]);
        }

        // Invalidate other sessions in guard
        Auth::logoutOtherDevices($request->password);

        // Delete from database sessions table
        $currentSessionId = $request->session()->getId();
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'All other browser sessions have been logged out securely.',
            'active_sessions_count' => 1,
        ]);
    }

    /**
     * Parse human-friendly device & browser names from user agent.
     */
    public static function parseUserAgent(?string $ua): array
    {
        if (empty($ua)) {
            return [
                'device_type' => 'desktop',
                'browser' => 'Web Browser',
                'platform' => 'Unknown OS',
            ];
        }

        // Platform
        $platform = 'Unknown OS';
        $deviceType = 'desktop';

        if (stripos($ua, 'Windows NT 10.0') !== false || stripos($ua, 'Windows NT 11.0') !== false) {
            $platform = 'Windows 10/11';
        } elseif (stripos($ua, 'Windows') !== false) {
            $platform = 'Windows';
        } elseif (stripos($ua, 'iPhone') !== false) {
            $platform = 'iOS (iPhone)';
            $deviceType = 'mobile';
        } elseif (stripos($ua, 'iPad') !== false) {
            $platform = 'iPadOS';
            $deviceType = 'tablet';
        } elseif (stripos($ua, 'Android') !== false) {
            $platform = 'Android';
            $deviceType = 'mobile';
        } elseif (stripos($ua, 'Macintosh') !== false || stripos($ua, 'Mac OS X') !== false) {
            $platform = 'macOS';
        } elseif (stripos($ua, 'Linux') !== false) {
            $platform = 'Linux';
        }

        // Browser
        $browser = 'Browser';
        if (stripos($ua, 'Edg/') !== false) {
            $browser = 'Microsoft Edge';
        } elseif (stripos($ua, 'Chrome') !== false && stripos($ua, 'Chromium') === false) {
            $browser = 'Google Chrome';
        } elseif (stripos($ua, 'Safari') !== false && stripos($ua, 'Chrome') === false) {
            $browser = 'Apple Safari';
        } elseif (stripos($ua, 'Firefox') !== false) {
            $browser = 'Mozilla Firefox';
        } elseif (stripos($ua, 'Opera') !== false || stripos($ua, 'OPR/') !== false) {
            $browser = 'Opera';
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'platform' => $platform,
        ];
    }
}
