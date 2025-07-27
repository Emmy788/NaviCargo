<?php

namespace App\Http\Controllers;

use App\Models\Crew; 
use App\Models\Ship;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Crew::query()->with('ship');

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('ship_id')) {
            $query->where('ship_id', $request->ship_id);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        return view('crew.index', [
            'crew' => $query->orderBy('last_name')->paginate(10),
            'roles' => Crew::select('role')->distinct()->pluck('role'),
            'ships' => Ship::select('id', 'name')->get(),
        ]);

        dd($query->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crew.create', [
        'ships' => Ship::all(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'phone_number' => 'required|string|max:50|unique:crews,phone_number,',
            'nationality' => 'nullable|string|max:100',
            'ship_id' => 'nullable|exists:ships,id',
        ]);

        Crew::create($validated);

        return redirect()->route('crew.index')->with('success', 'Crew member added.');

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
    public function edit($id)
    {
        $crew = Crew::findOrFail($id);
        $ships = Ship::all();

        return view('crew.edit', compact('crew', 'ships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $crew = Crew::findOrFail($id);

        $validated = $request->validate([
            'first_name'   => 'required|string|max:150',
            'last_name'    => 'required|string|max:150',
            'role'         => 'required|string',
            'phone_number' => 'required|string|max:30|unique:crews,phone_number,' . $crew->id,
            'nationality'  => 'nullable|string|max:100',
            'ship_id'      => 'nullable|exists:ships,id',
            'is_active'    => 'nullable|boolean',
        ]);

        // Normalize checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $crew->update($validated);

        return redirect()->route('crew.index')->with('success', 'Crew member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
