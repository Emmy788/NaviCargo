@extends('layouts.app')

@section('title', 'Ports')

@section('content')

<!-- Page Title -->
<div class="w-full flex justify-center">
    <h2 class="text-5xl font-extrabold text-gray-800 mb-10">Ports</h2>
</div>

<!-- Filter + Add Button Row -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 bg-white p-4 rounded-lg shadow">
    <form method="GET" action="{{ route('ports.index') }}" class="flex flex-wrap items-center gap-3 flex-grow">
        <!-- Filter Type -->
        <div>
            <label for="filter_type" class="block text-sm font-medium text-gray-700">Filter by</label>
            <select name="filter_type" id="filter_type" class="border border-gray-300 p-2 rounded-md w-full">
                <option value="">Select Type</option>
                <option value="country">Country</option>
                <option value="port_type">Port Type</option>
                <option value="customs_authorized">Customs</option>
                <option value="status">Status</option>
            </select>
        </div>

        <!-- Filter Value -->
        <div id="filter_value_wrapper" class="hidden">
            <label for="filter_value" class="block text-sm font-medium text-gray-700">Value</label>
            <select name="filter_value" id="filter_value" class="border border-gray-300 p-2 rounded-md w-full"></select>
        </div>

        <!-- Apply Button -->
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 mt-6 md:mt-0">
            Apply Filter
        </button>
    </form>

    <!-- Add Port Button -->
    <a href="{{ route('ports.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow whitespace-nowrap flex justify-center items-center">
        + Add Port
    </a>
</div>

<!-- Ports Table -->
<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full border border-gray-300 text-sm">
        <thead class="uppercase text-xs">
            <tr class="bg-gray-100 border">
                <th class="px-4 py-2 ">Port Name</th>
                <th class="px-4 py-2 ">Country</th>
                <th class="px-4 py-2 ">Type</th>
                <th class="px-4 py-2 ">Docking Capacity</th>
                <th class="px-4 py-2 ">Customs</th>
                <th class="px-4 py-2 ">Status</th>
                <th class="px-4 py-2 ">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ports as $port)
                <tr class="border hover:bg-gray-50 {{ !$port->is_active ? 'bg-yellow-100 shadow-sm' : '' }}">
                    <td class="px-4 py-2 ">{{ $port->name }}</td>
                    <td class="px-4 py-2 ">{{ $port->country }}</td>
                    <td class="px-4 py-2 ">{{ $port->port_type ?? '-' }}</td>
                    <td class="px-4 py-2 ">{{ $port->docking_capacity ?? '-' }}</td>
                    <td class="px-4 py-2 ">
                        @if($port->customs_authorized)
                            <span class="text-green-600 font-semibold">Yes</span>
                        @else
                            <span class="text-red-600 font-semibold">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($port->is_active)
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700 font-medium">Archived</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('ports.edit', $port->id) }}"
                            class="text-blue-600 hover:underline mr-2">Edit</a>
                        <!-- Optional: Add deactivate/archive button -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center px-4 py-6 text-gray-500">No ports found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $ports->withQueryString()->links() }}
</div>

@endsection

@push('scripts')
<script>
    const filterType = document.getElementById('filter_type');
    const filterValueWrapper = document.getElementById('filter_value_wrapper');
    const filterValue = document.getElementById('filter_value');

    const filterOptions = {
        country: @json($ports->pluck('country', 'country')->unique()->toArray()),
        port_type: {
            'Cargo': 'Cargo',
            'Passenger': 'Passenger',
            'Fishing': 'Fishing',
            'Military': 'Military'
        },
        customs_authorized: {
            '1': 'Yes',
            '0': 'No'
        },
        status: {
            'active': 'Active',
            'archived': 'Archived'
        }
    };

    filterType.addEventListener('change', function () {
        const selected = this.value;
        filterValue.innerHTML = '';

        if (!selected || !filterOptions[selected]) {
            filterValueWrapper.classList.add('hidden');
            return;
        }

        filterValueWrapper.classList.remove('hidden');

        const options = filterOptions[selected];
        for (const [key, label] of Object.entries(options)) {
            const option = document.createElement('option');
            option.value = key;
            option.text = label;
            filterValue.appendChild(option);
        }
    });
</script>
@endpush
