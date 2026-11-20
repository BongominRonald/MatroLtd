<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();

        $query = match ($status) {
            'trashed' => User::onlyTrashed()->withCount('orders'),
            'all' => User::withTrashed()->withCount('orders'),
            default => User::withCount('orders'),
        };

        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(int $id)
    {
        $user = User::withTrashed()->with(['orders.items'])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function updateRole(Request $request, int $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'For security reasons, you cannot change your own administrator role.');
        }

        $validated = $request->validate([
            'role' => ['required', 'in:admin,customer'],
        ]);

        $user->role = $validated['role'];
        $user->save();

        return back()->with('status', "User {$user->name}'s role has been updated to " . ucfirst($user->role) . ".");
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'For security reasons, you cannot deactivate your own administrator account.');
        }

        $user->delete();

        return back()->with('status', "User '{$user->name}' has been deactivated. They will no longer be able to log in.");
    }

    public function restore(int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('status', "User '{$user->name}' has been restored and can now access their account.");
    }

    public function profile()
    {
        $userId = auth()->id();
        $currentSessionId = request()->session()->getId();

        $sessions = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $userId)
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($s) use ($currentSessionId) {
                $deviceInfo = \App\Http\Controllers\SessionController::parseUserAgent($s->user_agent);
                return (object) [
                    'id' => $s->id,
                    'ip_address' => $s->ip_address ?: 'Unknown IP',
                    'is_current_device' => ($s->id === $currentSessionId),
                    'device_type' => $deviceInfo['device_type'],
                    'browser' => $deviceInfo['browser'],
                    'platform' => $deviceInfo['platform'],
                    'last_active' => \Illuminate\Support\Carbon::createFromTimestamp($s->last_activity)->diffForHumans(),
                ];
            });

        return view('admin.users.profile', [
            'user' => auth()->user(),
            'sessions' => $sessions,
        ]);
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user->name = $validated['name'];
        $user->email = strtolower($validated['email']);

        if (! empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
            $user->save();
            \Illuminate\Support\Facades\Auth::logoutOtherDevices($validated['new_password']);
        } else {
            $user->save();
        }

        return back()->with('status', 'Your profile settings and password have been updated successfully.');
    }
}
