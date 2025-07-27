@extends('layouts.app')

@section('title', 'Edit Port')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold text-center mb-6">Edit Port - {{ $port->name }}</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 text-red-700 bg-red-100 p-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ports.update', $port->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Port Name -->
            <div>
                <label for="name" class="block font-medium">Port Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $port->name) }}"
                    class="w-full mt-1 p-2 border rounded" required>
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block font-medium">Country <span class="text-red-500">*</span></label>
                <input type="text" name="country" id="country" value="{{ old('country', $port->country) }}"
                    class="w-full mt-1 p-2 border rounded" required>
            </div>

            <!-- Coordinates -->
            <!-- Latitude --> 
            <div class="md:col-span-2">
                <label for="latitude" class="block font-medium">Latitude <span class="text-red-500">*</span></label>
                <input type="number" step="any" name="latitude" id="latitude"
                    value="{{ old('latitude'), $port->latitude }}"
                    class="w-full mt-1 p-2 border rounded" required>
            </div>

            <!-- Longitude -->
            <div class="md:col-span-2">
                <label for="longitude" class="block font-medium">Longitude <span class="text-red-500">*</span></label>
                <input type="number" step="any" name="longitude" id="longitude"
                    value="{{ old('longitude'), $port->longitude }}"
                    class="w-full mt-1 p-2 border rounded" required>
            </div>

            <!-- Port Type -->
            <div>
                <label for="port_type" class="block font-medium">Port Type</label>
                <select name="port_type" id="port_type" class="w-full mt-1 p-2 border rounded">
                    <option value="">-- Select --</option>
                    <option value="Cargo" {{ old('port_type', $port->port_type) == 'Cargo' ? 'selected' : '' }}>Cargo</option>
                    <option value="Passenger" {{ old('port_type', $port->port_type) == 'Passenger' ? 'selected' : '' }}>Passenger</option>
                    <option value="Fishing" {{ old('port_type', $port->port_type) == 'Fishing' ? 'selected' : '' }}>Fishing</option>
                    <option value="Military" {{ old('port_type', $port->port_type) == 'Military' ? 'selected' : '' }}>Military</option>
                </select>
            </div>

            <!-- Docking Capacity -->
            <div>
                <label for="docking_capacity" class="block font-medium">Docking Capacity</label>
                <input type="number" name="docking_capacity" id="docking_capacity" value="{{ old('docking_capacity', $port->docking_capacity) }}"
                    class="w-full mt-1 p-2 border rounded">
            </div>

            <!-- Max Vessel Size -->
            <div>
                <label for="max_vessel_size" class="block font-medium">Max Vessel Size (m)</label>
                <input type="number" step="0.1" name="max_vessel_size" id="max_vessel_size" value="{{ old('max_vessel_size', $port->max_vessel_size) }}"
                    class="w-full mt-1 p-2 border rounded">
            </div>

            <!-- Depth -->
            <div>
                <label for="depth" class="block font-medium">Depth (m)</label>
                <input type="number" step="0.1" name="depth" id="depth" value="{{ old('depth', $port->depth) }}"
                    class="w-full mt-1 p-2 border rounded">
            </div>

            <!-- Security Level -->
            <div>
                <label for="security_level" class="block font-medium">Security Level</label>
                <select name="security_level" id="security_level" class="w-full mt-1 p-2 border rounded">
                    <option value="">-- Select --</option>
                    <option value="High" {{ old('security_level', $port->security_level) == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ old('security_level', $port->security_level) == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ old('security_level', $port->security_level) == 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>

            <!-- Customs Authorized -->
            <div class="mb-4 mt-6">
                <label for="customs_authorized" class="flex items-center space-x-2 text-gray-700">
                    
                    <!-- Hidden field ensures "0" is submitted if unchecked -->
                    <input type="hidden" name="customs_authorized" value="0">

                    <!-- Actual checkbox -->
                    <input type="checkbox" name="customs_authorized" id="customs_authorized" value="1"
                        {{ old('customs_authorized', $port->customs_authorized) ? 'checked' : '' }}
                        class="h-5 w-5 text-green-600 border-gray-300 rounded">
                    <span class="text-base">Customs Authorized</span>
                </label>
            </div>

            <!-- Status (Active or Archived) -->
            <div>
                <label for="is_active" class="block font-medium">Status</label>
                <select name="is_active" id="is_active" class="w-full mt-1 p-2 border rounded">
                    <option value="1" {{ old('is_active', $port->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $port->is_active) == 0 ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <!-- Operational Hours -->
            <div class="md:col-span-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="hours_per_day" class="block font-medium">Hours per Day <span class="text-red-500">*</span></label>
                    <input type="number" name="hours_per_day" id="hours_per_day"
                        value="{{ old('hours_per_day', explode('/', $port->operational_hours)[0] ?? '') }}"
                        min="1" max="24" class="w-full mt-1 p-2 border rounded" required>
                </div>

                <div>
                    <label for="days_per_week" class="block font-medium">Days per Week <span class="text-red-500">*</span></label>
                    <input type="number" name="days_per_week" id="days_per_week"
                        value="{{ old('days_per_week', explode('/', $port->operational_hours)[1] ?? '') }}"
                        min="1" max="7" class="w-full mt-1 p-2 border rounded" required>
                </div>
            </div>

            <!-- Port Manager -->
            <div class="md:col-span-2">
                <label for="port_manager" class="block font-medium">Port Manager</label>
                <input type="text" name="port_manager" id="port_manager" value="{{ old('port_manager', $port->port_manager) }}"
                    class="w-full mt-1 p-2 border rounded">
            </div>

            <!-- Contact Info -->
            <div class="md:col-span-2">
                <label for="port_contact_info" class="block font-medium">Contact Info</label>
                <input type="text" name="port_contact_info" id="port_contact_info" value="{{ old('port_contact_info', $port->port_contact_info) }}"
                    class="w-full mt-1 p-2 border rounded">
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="mt-6 flex justify-between items-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Update Port
            </button>

            <a href="{{ route('ports.index') }}"
                class="text-gray-600 hover:text-gray-800 underline">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection

<!-- Auto-fetch coordinates when name is typed -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('name');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    let lastSearched = '';

    nameInput.addEventListener('blur', async function () {
        // if (latitudeInput.value || longitudeInput.value) return;

        const name = this.value.trim();
        if (!name || name === lastSearched) return;

        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(name)}`);
        const data = await response.json();

        if (data && data.length > 0) {
            latitudeInput.value = data[0].lat;
            longitudeInput.value = data[0].lon;
            lastSearched = name;
        } else {
            alert("Coordinates not found for this port name.");
        }
    });
});
</script>




