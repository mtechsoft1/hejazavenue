<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Accommodation;
use App\AccommodationImage;
use App\ChauffeurService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::with(['images', 'chauffeurService'])
            ->ordered()
            ->paginate(15);
        return view('admin.accommodation.index', compact('accommodations'));
    }

    public function create()
    {
        $chauffeurServices = ChauffeurService::active()->ordered()->get();
        return view('admin.accommodation.create', compact('chauffeurServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Apartment,Villa',
            'city' => 'nullable|string|max:100',
            'distance_meters' => 'required|integer|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'min_guests' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1|gte:min_guests',
            'price_per_night' => 'required|numeric|min:0',
            'is_active' => 'nullable|in:0,1',
            'chauffeur_service_id' => 'nullable|exists:chauffeur_services,id',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $slug = Str::slug($validated['title']);
        $exists = Accommodation::where('slug', $slug)->exists();
        if ($exists) {
            $slug = $slug . '-' . now()->format('YmdHis');
        }

        $data = [
            'title' => $validated['title'],
            'slug' => $slug,
            'type' => $validated['type'],
            'city' => $validated['city'] ?? 'Madina',
            'distance_meters' => $validated['distance_meters'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'bedrooms' => $validated['bedrooms'],
            'bathrooms' => $validated['bathrooms'],
            'min_guests' => $validated['min_guests'],
            'max_guests' => $validated['max_guests'],
            'dedicated_maid_included' => true,
            'driver_included' => true,
            'chauffeur_included' => true,
            'price_per_night' => $validated['price_per_night'],
            'is_active' => $request->boolean('is_active'),
            'chauffeur_service_id' => $validated['chauffeur_service_id'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ];

        $accommodation = Accommodation::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('accommodations', 'public');
                $accommodation->images()->create([
                    'path' => $path,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.accommodation.index')->with('message', 'Accommodation created successfully.');
    }

    public function show($id)
    {
        $accommodation = Accommodation::with(['images', 'chauffeurService'])->findOrFail($id);
        return view('admin.accommodation.show', compact('accommodation'));
    }

    public function edit($id)
    {
        $accommodation = Accommodation::with('images')->findOrFail($id);
        $chauffeurServices = ChauffeurService::active()->ordered()->get();
        return view('admin.accommodation.edit', compact('accommodation', 'chauffeurServices'));
    }

    public function update(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Apartment,Villa',
            'city' => 'nullable|string|max:100',
            'distance_meters' => 'required|integer|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'min_guests' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1|gte:min_guests',
            'price_per_night' => 'required|numeric|min:0',
            'is_active' => 'nullable|in:0,1',
            'chauffeur_service_id' => 'nullable|exists:chauffeur_services,id',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:accommodation_images,id',
            'primary_image_id' => 'nullable|integer|exists:accommodation_images,id',
        ]);

        $slug = Str::slug($validated['title']);
        $exists = Accommodation::where('slug', $slug)->where('id', '!=', $accommodation->id)->exists();
        if ($exists) {
            $slug = $slug . '-' . $accommodation->id;
        }

        $data = [
            'title' => $validated['title'],
            'slug' => $slug,
            'type' => $validated['type'],
            'city' => $validated['city'] ?? 'Madina',
            'distance_meters' => $validated['distance_meters'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'bedrooms' => $validated['bedrooms'],
            'bathrooms' => $validated['bathrooms'],
            'min_guests' => $validated['min_guests'],
            'max_guests' => $validated['max_guests'],
            'price_per_night' => $validated['price_per_night'],
            'is_active' => $request->boolean('is_active'),
            'chauffeur_service_id' => $validated['chauffeur_service_id'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ];

        $accommodation->update($data);

        if (!empty($validated['delete_images'])) {
            foreach ($validated['delete_images'] as $imageId) {
                $img = AccommodationImage::where('accommodation_id', $accommodation->id)->find($imageId);
                if ($img) {
                    $img->delete();
                }
            }
        }

        if (!empty($validated['primary_image_id'])) {
            $accommodation->images()->update(['is_primary' => false]);
            $primary = $accommodation->images()->find($validated['primary_image_id']);
            if ($primary) {
                $primary->update(['is_primary' => true]);
            }
        }

        if ($request->hasFile('images')) {
            $startOrder = $accommodation->images()->max('sort_order') ?? -1;
            $hadNoImages = $accommodation->images()->count() === 0;
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('accommodations', 'public');
                $accommodation->images()->create([
                    'path' => $path,
                    'sort_order' => $startOrder + 1 + $index,
                    'is_primary' => $hadNoImages && $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.accommodation.index')->with('message', 'Accommodation updated successfully.');
    }

    public function destroy($id)
    {
        $accommodation = Accommodation::with('images')->findOrFail($id);
        $accommodation->delete(); // cascade deletes images; each image's deleting event removes file from storage
        return redirect()->route('admin.accommodation.index')->with('message', 'Accommodation deleted successfully.');
    }
}
