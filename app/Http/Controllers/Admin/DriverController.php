<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::ordered()->paginate(15);
        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'license_number' => 'nullable|string|max:100',
            'license_expiry_date' => 'nullable|date',
            'experience_years' => 'nullable|integer|min:0|max:99',
            'languages' => 'nullable|array',
            'languages.*' => 'in:arabic,english,urdu',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'] ?? null,
            'license_number' => $validated['license_number'] ?? null,
            'license_expiry_date' => $validated['license_expiry_date'] ?? null,
            'experience_years' => $validated['experience_years'] ?? 0,
            'languages' => $validated['languages'] ?? [],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('drivers', 'public');
        }

        Driver::create($data);
        return redirect()->route('admin.driver.index')->with('message', 'Driver added successfully.');
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.driver.show', compact('driver'));
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'license_number' => 'nullable|string|max:100',
            'license_expiry_date' => 'nullable|date',
            'experience_years' => 'nullable|integer|min:0|max:99',
            'languages' => 'nullable|array',
            'languages.*' => 'in:arabic,english,urdu',
            'is_active' => 'nullable|in:0,1',
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'] ?? null,
            'license_number' => $validated['license_number'] ?? null,
            'license_expiry_date' => $validated['license_expiry_date'] ?? null,
            'experience_years' => $validated['experience_years'] ?? 0,
            'languages' => $validated['languages'] ?? [],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($driver->image) {
                Storage::disk('public')->delete($driver->image);
            }
            $data['image'] = $request->file('image')->store('drivers', 'public');
        }

        $driver->update($data);
        return redirect()->route('admin.driver.index')->with('message', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        if ($driver->image) {
            Storage::disk('public')->delete($driver->image);
        }
        $driver->delete();
        return redirect()->route('admin.driver.index')->with('message', 'Driver deleted successfully.');
    }
}
