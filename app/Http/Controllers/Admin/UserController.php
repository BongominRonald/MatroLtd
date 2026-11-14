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
        $query = User::withCount('orders');

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

    public function show(User $user)
    {
        $user->load(['orders.items']);

        return view('admin.users.show', compact('user'));
    }

    public function profile()
    {
        return view('admin.users.profile', [
            'user' => auth()->user(),
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
        }

        $user->save();

        return back()->with('status', 'Admin account settings updated successfully.');
    }
}
