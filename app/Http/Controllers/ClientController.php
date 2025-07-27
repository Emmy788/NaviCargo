<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // Enhanced search by company or contact person
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // Filter by active/inactive status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $clients = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email_address' => 'nullable|email|unique:clients,email_address',
            'phone_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        // Normalize phone number by removing spaces
        if (!empty($validated['phone_number'])) {
            $validated['phone_number'] = str_replace(' ', '', $validated['phone_number']);
        }

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Reactivate the specified resource.
     */
    public function reactivate(Client $client)
    {
        $client->update(['status' => 'active']);

        return redirect()->route('clients.index')->with('success', 'Client reactivated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:150',
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email_address' => 'nullable|email|unique:clients,email_address,' . $client->id,
            'phone_number' => 'nullable|regex:/^\+?[0-9]{1,15}$/',
            'address' => 'nullable|string',
        ]);

        // Normalize phone number
        if (!empty($validated['phone_number'])) {
            $validated['phone_number'] = str_replace(' ', '', $validated['phone_number']);
        }

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Deactivate the specified resource.
     */
    public function destroy(Client $client)
    {
        $client->update(['status' => 'inactive']);

        return redirect()->route('clients.index')->with('success', 'Client deactivated.');
    }
}
