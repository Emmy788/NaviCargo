@extends('layouts.app')

@section('title', 'Add Ship')

@section('content')
    <div class="w-full flex justify-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8">Add Ship</h2>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('ships.store') }}" class="space-y-5">
            @csrf

            {{-- Ship Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Ship Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Type <span class="text-red-500">*</span></label>
                <select name="type"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">-- Select Type --</option>
                    <option value="container" {{ old('type') == 'container' ? 'selected' : '' }}>Container</option>
                    <option value="tanker" {{ old('type') == 'tanker' ? 'selected' : '' }}>Tanker</option>
                    <option value="bulk carrier" {{ old('type') == 'bulk carrier' ? 'selected' : '' }}>Bulk Carrier</option>
                    <option value="passenger" {{ old('type') == 'passenger' ? 'selected' : '' }}>Passenger</option>
                    <option value="ro-ro" {{ old('type') == 'ro-ro' ? 'selected' : '' }}>Ro-Ro</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Capacity in Tonnes --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Capacity (in tonnes) <span class="text-red-500">*</span></label>
                <input type="number" name="capacity_in_tonnes" value="{{ old('capacity_in_tonnes') }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('capacity_in_tonnes')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Registration Number --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Registration Number <span class="text-red-500">*</span></label>
                <input type="text" name="registration_number" value="{{ old('registration_number') }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('registration_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">-- Select Status --</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="decommissioned" {{ old('status') == 'decommissioned' ? 'selected' : '' }}>Decommissioned</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Save Ship
                </button>
            </div>
        </form>
    </div>
@endsection
