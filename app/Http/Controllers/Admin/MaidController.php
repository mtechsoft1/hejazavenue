<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Maid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaidController extends Controller
{
    public function index()
    {
        $maids = Maid::ordered()->paginate(15);
        return view('admin.maid.index', compact('maids'));
    }

    public function create()
    {
        return view('admin.maid.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email' => 'nullable|email|max:255',
            'nationality' => 'nullable|string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:99',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'experience_years' => $validated['experience_years'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('maids', 'public');
        }

        Maid::create($data);
        return redirect()->route('admin.maid.index')->with('message', 'Maid added successfully.');
    }

    public function show($id)
    {
        $maid = Maid::findOrFail($id);
        return view('admin.maid.show', compact('maid'));
    }

    public function edit($id)
    {
        $maid = Maid::findOrFail($id);
        return view('admin.maid.edit', compact('maid'));
    }

    public function update(Request $request, $id)
    {
        $maid = Maid::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email' => 'nullable|email|max:255',
            'nationality' => 'nullable|string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:99',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'experience_years' => $validated['experience_years'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($maid->image) {
                Storage::disk('public')->delete($maid->image);
            }
            $data['image'] = $request->file('image')->store('maids', 'public');
        }

        $maid->update($data);
        return redirect()->route('admin.maid.index')->with('message', 'Maid updated successfully.');
    }

    public function destroy($id)
    {
        $maid = Maid::findOrFail($id);
        if ($maid->image) {
            Storage::disk('public')->delete($maid->image);
        }
        $maid->delete();
        return redirect()->route('admin.maid.index')->with('message', 'Maid deleted successfully.');
    }
}
