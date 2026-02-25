<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ChauffeurService;
use Illuminate\Http\Request;

class ChauffeurServiceController extends Controller
{
    public function index()
    {
        $chauffeurServices = ChauffeurService::orderBy('sort_order')->orderBy('name')->paginate(15);
        return view('admin.chauffeur_service.index', compact('chauffeurServices'));
    }

    public function create()
    {
        return view('admin.chauffeur_service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'extra_price' => 'nullable|numeric|min:0',
            'capacity'   => 'nullable|string|max:100',
            'vehicle_number' => 'nullable|string|max:100',
            'model'      => 'nullable|string|max:100',
            'color'      => 'nullable|string|max:50',
            'is_default' => 'nullable|in:0,1',
            'is_active'  => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'description', 'capacity', 'vehicle_number', 'model', 'color', 'is_active', 'sort_order']);
        $data['extra_price'] = $request->input('extra_price', 0);
        $data['is_default'] = $request->boolean('is_default');

        ChauffeurService::create($data);
        return redirect()->route('admin.chauffeur_service.index')->with('message', 'Chauffeur service added successfully.');
    }

    public function show($id)
    {
        $chauffeurService = ChauffeurService::findOrFail($id);
        return view('admin.chauffeur_service.show', compact('chauffeurService'));
    }

    public function edit($id)
    {
        $chauffeurService = ChauffeurService::findOrFail($id);
        return view('admin.chauffeur_service.edit', compact('chauffeurService'));
    }

    public function update(Request $request, $id)
    {
        $chauffeurService = ChauffeurService::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'extra_price' => 'nullable|numeric|min:0',
            'capacity'   => 'nullable|string|max:100',
            'vehicle_number' => 'nullable|string|max:100',
            'model'      => 'nullable|string|max:100',
            'color'      => 'nullable|string|max:50',
            'is_default' => 'nullable|in:0,1',
            'is_active'  => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'description', 'capacity', 'vehicle_number', 'model', 'color', 'is_active', 'sort_order']);
        $data['extra_price'] = $request->input('extra_price', 0);
        $data['is_default'] = $request->boolean('is_default');

        $chauffeurService->update($data);
        return redirect()->route('admin.chauffeur_service.index')->with('message', 'Chauffeur service updated successfully.');
    }

    public function destroy($id)
    {
        $chauffeurService = ChauffeurService::findOrFail($id);
        $chauffeurService->delete();
        return redirect()->route('admin.chauffeur_service.index')->with('message', 'Chauffeur service deleted successfully.');
    }
}
