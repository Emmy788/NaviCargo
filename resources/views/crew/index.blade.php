@extends('layouts.app')

@section('title', 'Crew Members')

@section('content')
<div class="w-full">
    <!-- Page Title -->
    <div class="flex justify-center mb-6">
        <h2 class="text-4xl font-extrabold text-gray-800">Crew Members</h2>
    </div>

    <!-- Actions: Filter + Add Crew -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form method="GET" action="{{ route('crew.index') }}" class="flex flex-wrap gap-4 items-center">
            <select name="role" class="px-3 py-2 border border-gray-300 rounded">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>

            <select name="ship_id" class="px-3 py-2 border border-gray-300 rounded">
                <option value="">All Ships</option>
                @foreach($ships as $ship)
                    <option value="{{ $ship->id }}" {{ request('ship_id') == $ship->id ? 'selected' : '' }}>
                        {{ $ship->name }}
                    </option>
                @endforeach
            </select>

            <select name="is_active" class="px-3 py-2 border border-gray-300 rounded">
                <option value="">All Statuses</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filter
            </button>
        </form>

        <a href="{{ route('crew.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Add Crew
        </a>
    </div>

    {{-- Crew Table --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Ship</th>
                    <th class="px-4 py-3">Nationality</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($crew as $member)
                    <tr>
                        <td class="px-4 py-2">{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td class="px-4 py-2">{{ $member->role }}</td>
                        <td class="px-4 py-2">{{ $member->phone_number }}</td>
                        <td class="px-4 py-2">{{ $member->ship?->name ?? 'Unassigned' }}</td>
                        <td class="px-4 py-2">{{ $member->nationality ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="{{ $member->is_active ? 'text-green-700' : 'text-red-700' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('crew.edit', $member) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('crew.destroy', $member) }}" method="POST"
                                  onsubmit="return confirm('Deactivate this crew member?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Deactivate</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-4 text-gray-500">
                            No crew members found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $crew->withQueryString()->links() }}
    </div>
</div>
@endsection
