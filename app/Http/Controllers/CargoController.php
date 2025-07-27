<?php

namespace App\Http\Controllers;

use App\Models\Cargo;  // or wherever your Cargo class is located
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cargo::with('client');

        // Filter by client name 
        if ($request->filled('client')) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->client . '%');
            });    
        }

        // Filter by cargo_type
        if ($request->filled('cargo_type')) {
            $query->where('cargo_type', $request->cargo_type);
        }
        
        // Filter by Status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'archived') {
                $query->where('is_active', false);
            }
        }

        if ($request->sort_by === 'weight') {
            $query->orderBy('weight', 'desc');
        } elseif ($request->sort_by === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        $cargo = $query->paginate(10);

        return view('cargo.index', compact('cargo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = \App\Models\Client::all(); // or Client::pluck('name', 'id')
        return view('cargo.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'weight' => 'required|numeric|min:0.01',
            'volume' => 'nullable|numeric',
            'client_id' => 'required|exists:clients,id',
            'cargo_type' => 'nullable|in:perishable,dangerous,general,other',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Cargo::create($validated);

        return redirect()->route('cargo.index')->with('success', 'Cargo registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cargo = \App\Models\Cargo::findOrFail($id);
        $clients = \App\Models\Client::all();
        return view('cargo.edit', compact('cargo', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'weight' => 'required|numeric|min:0.01',
            'volume' => 'nullable|numeric',
            'client_id' => 'required|exists:clients,id',
            'cargo_type' => 'nullable|in:perishable,dangerous,general,other',
        ]);

        if ($request->cargo_type === 'dangerous' && $cargo->cargo_type !== 'dangerous') {
            // Example logic: log or confirm safety
            Log::info("Dangerous cargo updated: confirmation required.");
        }

        // Handle the checkbox manually
        $validated['is_active'] = $request->has('is_active');

        $cargo->update($validated);

        return redirect()->route('cargo.index')->with('success', 'Cargo updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->update(['is_active' => false]);

        return redirect()->route('cargo.index')->with('success', 'Cargo deactivated.');
    }
}
