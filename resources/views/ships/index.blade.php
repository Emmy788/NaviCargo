@extends('layouts.app')

@section('title', 'Ships')

@section('content')
    <!-- Page Title -->
    <div class="w-full flex justify-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8">Ships</h2>
    </div>

    <!-- Search, Filter, and Add Ship -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 bg-white p-4 rounded-lg shadow">
        <form method="GET" action="{{ route('ships.index') }}" class="flex flex-wrap items-center gap-3 flex-grow">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name or registration..."
                class="border border-gray-300 rounded-md px-4 py-2 w-full sm:w-64"
            >
            <select name="status" class="border border-gray-300 rounded-md px-4 py-2">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="decommissioned" {{ request('status') == 'decommissioned' ? 'selected' : '' }}>Decommissioned</option>
            </select>
            <button type="submit" class="bg-gray-600 text-white px-5 py-2 rounded-md hover:bg-gray-700">
                Filter
            </button>
        </form>

        <!-- Add Ship -->
        <a href="{{ route('ships.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow whitespace-nowrap flex justify-center items-center">
            + Add Ship
        </a>
    </div>

    <!-- Ships Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-100 uppercase text-xs border-b">
                <tr>
                    <th class="px-6 py-3">Ship Name</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Capacity (tonnes)</th>
                    <th class="px-6 py-3">Reg. Number</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($ships as $ship)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $ship->name }}</td>
                        <td class="px-6 py-4 capitalize">{{ $ship->type }}</td>
                        <td class="px-6 py-4">{{ number_format($ship->capacity_in_tonnes, 2) }}</td>
                        <td class="px-6 py-4">{{ $ship->registration_number }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                @if($ship->status === 'active')
                                    bg-green-100 text-green-700
                                @elseif($ship->status === 'maintenance')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst($ship->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('ships.edit', $ship) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                            @if($ship->status !== 'decommissioned')
                                <form method="POST" action="{{ route('ships.destroy', $ship) }}" onsubmit="return confirm('Deactivate this ship?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-medium">Deactivate</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">No ships found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $ships->links('pagination::tailwind') }}
    </div>
@endsection

