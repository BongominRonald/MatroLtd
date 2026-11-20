<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query();

        if ($request->boolean('unread')) {
            $query->where('is_read', false);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%")
                    ->orWhere('subject', 'like', "%{$s}%");
            });
        }

        $inquiries = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        if (! $inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function toggleRead(Inquiry $inquiry)
    {
        $inquiry->update(['is_read' => ! $inquiry->is_read]);

        $msg = $inquiry->is_read ? 'Inquiry marked as read.' : 'Inquiry marked as unread.';
        return back()->with('status', $msg);
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,resolved',
        ]);

        $inquiry->update($validated);

                $labels = [
            'new' => 'New',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
        ];
        $statusLabel = $labels[$validated['status']] ?? ucfirst($validated['status']);
        return back()->with('status', "Inquiry status has been updated to {$statusLabel}.");
    }
}
