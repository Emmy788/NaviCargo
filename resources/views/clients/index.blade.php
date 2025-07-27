@extends('layouts.app')

@section('title', 'Clients')

@section('content')

    <!-- Page Title -->
    <div class="w-full flex justify-center">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-10">Clients</h2>
    </div>

    <!-- Search, Filter & Add Button -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 bg-white p-4 rounded-lg shadow">
        <form method="GET" action="{{ route('clients.index') }}" class="flex flex-wrap items-center gap-3 flex-grow">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by company or contact person..."
                class="pl-5 pr-4 py-2 w-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none"
            >
            <select name="status" class="border border-gray-300 rounded-md px-4 py-2">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Filter
            </button>

        </form>

        <!-- Add Client Button -->
        <a href="{{ route('clients.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow whitespace-nowrap flex justify-center items-center">
            + Add Client
        </a>
    </div>

    <!-- Table -->
    <div class="w-full overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full min-w-[600px] text-left text-sm">
            <thead class="bg-gray-100 border uppercase text-xs ">
                <tr>
                    <th class="px-4 py-2 ">Company Name</th>
                    <th class="px-4 py-2 ">Contact Name</th>
                    <th class="px-4 py-2 "> Email</th> 
                    <th class="px-4 py-2 ">Phone</th>                
                    <th class="px-4 py-2 ">Status</th>
                    <th class="px-4 py-2 ">Actions</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($clients as $client)
                    <tr class="border hover:bg-gray-50 {{ $client->status === 'inactive' ? 'bg-gray-50' : '' }}">
                        <td class="px-4 py-2">{{ $client->company_name ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $client->first_name }} {{ $client->last_name }}</td>
                        <td class="px-4 py-2">{{ $client->email_address ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $client->formatted_phone ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                {{ $client->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($client->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline">
                                Edit
                            </a>

                            @if($client->status === 'active')
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Deactivate this client?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Deactivate</button>
                                </form>
                            @else
                                <form action="{{ route('clients.reactivate', $client) }}" method="POST" onsubmit="return confirm('Reactivate this client?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:underline">Reactivate</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">No clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $clients->links('pagination::tailwind') }}
    </div>
@endsection
