@extends('layouts.app')

@section('title', 'Cargo')

@section('content')

<!-- Page Title -->
<div class="container mx-auto ">
    <div class="w-full flex justify-center">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-10">Cargo List</h2>
    </div>

    <!-- Filter section-->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 bg-white p-4 rounded-lg shadow">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <input type="text" name="client" placeholder="Filter by client..." value="{{ request('client') }}" class="p-2 border rounded">
            <select name="cargo_type" class="p-2 border rounded">
                <option value="">All Types</option>
                @foreach(['perishable', 'dangerous', 'general', 'other'] as $type)
                    <option value="{{ $type }}" {{ request('cargo_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            <select name="status" class="p-2 border rounded">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select> 

            <button class="bg-gray-600 text-white px-4 py-2 rounded">Filter</button>

        </form>

        <!-- Add Cargo Button -->
        <a href="{{ route('cargo.create') }}" class="bg-blue-600 text-white text-center px-4 py-2 rounded w-full md:w-auto self-start flex justify-center items-center">
            + Add Cargo
        </a>
        
    </div>
</div>

    <!-- Table -->
    <div class="w-full overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full min-w-[600px] text-left text-sm">
            <thead class="bg-gray-100 uppercase text-xs ">
                <tr class="bg-gray-100 text-left px-4 py-2">
                    <th class="text-left px-4 py-2">Client</th>
                    <th class="text-left px-4 py-2 p-2">Description</th>
                    <th class="text-left px-4 py-2">Weight (kg)</th>
                    <th class="text-left px-4 py-2">Volume (m³)</th>
                    <th class="text-left px-4 py-2">Type</th>
                    <th class="text-left px-4 py-2">Status</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cargo as $item)
                <tr class="{{ $item->cargo_type == 'dangerous' ? 'bg-red-100' : 'hover:bg-gray-50' }} border-t">
                    <td class="px-4 py-2">{{ $item->client->company_name ?? 'N/A'}}</td>
                    <td class="p-2">{{ $item->description }}</td>
                    <td class="px-4 py-2">{{ $item->weight }}</td>
                    <td class="px-4 py-2">{{ $item->volume }}</td>
                    <td class="px-4 py-2">{{ ucfirst($item->cargo_type) }}</td>
                    <td class="px-4 py-2">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                            {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    <td class="px-4 py-2">
                        <a href="{{ route('cargo.edit', $item->id) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    <div class="mt-4">
        {{ $cargo->withQueryString()->links() }}
    </div>
</div>
@endsection
