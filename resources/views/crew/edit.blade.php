@extends('layouts.app')

@section('title', 'Edit Crew Member')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-6">Edit Crew Member</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('crew.update', $crew->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name" class="block text-sm font-medium">First Name <span class="text-red-500">*</span></label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $crew->first_name) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium">Last Name <span class="text-red-500">*</span></label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $crew->last_name) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium">Role <span class="text-red-500">*</span></label>
            <select name="role" id="role" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
                <option value="">Select Role</option>
                @foreach ([
                    'Captain', 'Chief Officer', 'Able Seaman', 'Ordinary Seaman',
                    'Engine Cadet', 'Radio Officer', 'Chief Cook', 'Steward', 'Deckhand'
                ] as $role)
                    <option value="{{ $role }}" {{ old('role', $crew->role) === $role ? 'selected' : '' }}>{{ $role }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="phone_number" class="block text-sm font-medium">Phone Number <span class="text-red-500">*</span></label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $crew->phone_number) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
        </div>

        <div>
            <label for="nationality" class="block text-sm font-medium">Nationality</label>
            <input type="text" name="nationality" id="nationality" value="{{ old('nationality', $crew->nationality) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1">
        </div>

        <div>
            <label for="ship_id" class="block text-sm font-medium">Assigned Ship</label>
            <select name="ship_id" id="ship_id" class="w-full border-gray-300 rounded px-3 py-2 mt-1">
                <option value="">-- None --</option>
                @foreach ($ships as $ship)
                    <option value="{{ $ship->id }}" {{ old('ship_id', $crew->ship_id) == $ship->id ? 'selected' : '' }}>
                        {{ $ship->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-2 pt-4">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $crew->is_active ? 'checked' : '' }}>
            <label for="is_active" class="text-sm">Active</label>
        </div>

        <div class="text-center pt-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Update</button>
            <a href="{{ route('crew.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
