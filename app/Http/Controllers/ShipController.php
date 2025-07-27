<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Step 1: Start the query
        $query = Ship::query();

        // Step 2: Apply filters based on query parameters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Step 3: Apply sorting and pagination
        $ships = $query->orderBy('capacity_in_tonnes', 'desc')
                       ->paginate(10);

        // Step 4: Return the view with data
        return view('ships.index', compact('ships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'registration_number' => 'required|unique:ships',
            'capacity_in_tonnes' => 'numeric|min:1'
        ]);

        // ✅ If validation passes, create ship
        Ship::create($request->all());

        return redirect()->route('ships.index')->with('success', 'Ship created successfully.');

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
    public function edit(\App\Models\Ship $ship)
    {
        return view('ships.edit', compact('ship'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ship $ship)
    {
        // ✅ Validation (ignore the current ship's registration_number for uniqueness)
        $request->validate([
            'registration_number' => 'required|unique:ships,registration_number,' . $ship->id,
            'capacity_in_tonnes' => 'numeric|min:1'
        ]);

        // ✅ If validation passes, update ship
        $ship->update($request->all());

        return redirect()->route('ships.index')->with('success', 'Ship updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ship $ship)
    {
        $ship->update([
            'is_active' => false,
            'status' => 'decommissioned', // optional: mark as decommissioned
        ]);

        return redirect()->route('ships.index')->with('success', 'Ship deactivated successfully.');
    }
}