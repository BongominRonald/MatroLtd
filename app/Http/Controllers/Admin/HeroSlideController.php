<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.form', [
            'slide' => null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateSlide($request);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('hero-slides', 'public');
            $data['image'] = 'storage/' . $path;
            $data['image_webp'] = null;
        }

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.form', [
            'slide' => $heroSlide,
        ]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $this->validateSlide($request);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('hero-slides', 'public');
            $data['image'] = 'storage/' . $path;
            $data['image_webp'] = null;
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('status', 'Hero slide deleted.');
    }

    public function toggleActive(HeroSlide $heroSlide)
    {
        $heroSlide->update([
            'is_active' => ! $heroSlide->is_active,
        ]);

        $state = $heroSlide->is_active ? 'activated' : 'hidden';

        return back()->with('status', "Hero slide \"{$heroSlide->title}\" {$state}.");
    }

    private function validateSlide(Request $request): array
    {
        $validated = $request->validate([
            'eyebrow' => 'nullable|string|max:120',
            'title' => 'required|string|max:255',
            'title_highlight' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:1500',
            'primary_cta_text' => 'nullable|string|max:80',
            'primary_cta_url' => 'nullable|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:80',
            'secondary_cta_url' => 'nullable|string|max:255',
            'image' => 'required|string|max:500',
            'image_webp' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0|max:999',
            'stat_values' => 'nullable|array|max:4',
            'stat_values.*' => 'nullable|string|max:60',
            'stat_labels' => 'nullable|array|max:4',
            'stat_labels.*' => 'nullable|string|max:80',
        ]);

        $stats = [];
        $values = $request->input('stat_values', []);
        $labels = $request->input('stat_labels', []);

        for ($i = 0; $i < 4; $i++) {
            $val = trim((string) ($values[$i] ?? ''));
            $lbl = trim((string) ($labels[$i] ?? ''));
            if ($val !== '' || $lbl !== '') {
                $stats[] = [
                    'value' => $val,
                    'label' => $lbl,
                ];
            }
        }

        return [
            'eyebrow' => $validated['eyebrow'] ?? null,
            'title' => $validated['title'],
            'title_highlight' => $validated['title_highlight'] ?? null,
            'description' => $validated['description'] ?? null,
            'primary_cta_text' => $validated['primary_cta_text'] ?? null,
            'primary_cta_url' => $validated['primary_cta_url'] ?? null,
            'secondary_cta_text' => $validated['secondary_cta_text'] ?? null,
            'secondary_cta_url' => $validated['secondary_cta_url'] ?? null,
            'image' => $validated['image'],
            'image_webp' => $validated['image_webp'] ?: null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active'),
            'stats' => $stats,
        ];
    }
}
