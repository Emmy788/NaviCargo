@extends('layouts.app')

@section('title', 'Shipments')

@section('content')
<div class="container mx-auto">
    <!-- Page Title -->
    <div class="w-full flex justify-center">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-10">Shipments</h2>
    </div>

    <!-- Filter + Button Row -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 bg-white p-4 rounded-lg shadow">
    
    <!-- Filter form -->
    <form method="GET" action="{{ route('shipments.index') }}">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Filter Type -->
            <div>
                <label for="filter_type" class="block text-sm font-medium text-gray-700">Filter by</label>
                <select name="filter_type" id="filter_type" class="border p-2 rounded">
                    <option value="">Select Type</option>
                    <option value="status">Status</option>
                    <option value="origin_port_id">Origin Port</option>
                    <option value="destination_port_id">Destination Port</option>
                    <option value="ship_id">Ship</option>
                    <option value="cargo_id">Cargo</option>
                    <option value="date_range">Departure Date</option>
                </select>
            </div>

            <!-- Dynamic Filter Value -->
            <div id="filter_value_wrapper" class="hidden">
                <label for="filter_value" class="block text-sm font-medium text-gray-700">Value</label>
                <select name="filter_value" id="filter_value" class="border p-2 rounded"></select>
            </div>

            <!-- Date Range -->
            <div id="date_range_inputs" class="hidden gap-2">
                <div>
                    <label for="from_date" class="block text-sm">From</label>
                    <input type="date" name="from_date" class="border p-2 rounded">
                </div>
                <div>
                    <label for="to_date" class="block text-sm">To</label>
                    <input type="date" name="to_date" class="border p-2 rounded">
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-6">Apply Filter</button>
        </div>
    </form>

    <!-- Add Shipment button -->
    <a href="{{ route('shipments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded h-fit mt-6 flex justify-center items-center">Add Shipment</a>
</div>

    <!-- Shipments Table -->
    <div class="w-full overflow-x-auto bg-white shadow rounded-lg"> 
        <table class="w-full min-w-[600px] text-medium text-sm">
            <thead class="bg-gray-100 border uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 ">Cargo</th>
                    <th class="px-4 py-2 ">Ship</th>
                    <th class="px-4 py-2 ">From</th>
                    <th class="px-4 py-2 ">To</th>
                    <th class="px-4 py-2 ">Status</th>
                    <th class="px-4 py-2 ">Departure</th>
                    <th class="px-4 py-2 ">Arrival</th>
                    <th class="px-4 py-2 ">Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach($shipments as $shipment)
                <tr class="border hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $shipment->cargo->description ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $shipment->ship->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $shipment->originPort->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $shipment->destinationPort->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">
                        @php
                            $status = strtolower(str_replace(['-', ' '], '_', $shipment->status));
                        @endphp

                        @if ($status === 'delivered')
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-green-100 text-green-800">
                                {{ ucfirst($shipment->status) }}
                            </span>
                        @elseif ($status === 'delayed')
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-yellow-100 text-yellow-800">
                                {{ ucfirst($shipment->status) }}
                            </span>
                        @elseif ($status === 'in_transit')
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-blue-100 text-blue-800">
                                {{ ucfirst($shipment->status) }}
                            </span>
                        @elseif ($status === 'pending')
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-purple-100 text-purple-800">
                                {{ ucfirst($shipment->status) }}
                            </span>    
                        @elseif ($status === 'cancelled')
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-red-100 text-red-800">
                                {{ ucfirst($shipment->status) }}
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded bg-gray-100 text-gray-800">
                                {{ ucfirst($shipment->status) }}
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-2">{{ $shipment->departure_date }}</td>
                    <td class="px-4 py-2">{{ $shipment->arrival_estimate }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('shipments.edit', $shipment->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    

    <div class="mt-4">
        {{ $shipments->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    const filterType = document.getElementById('filter_type');
    const filterValueWrapper = document.getElementById('filter_value_wrapper');
    const filterValue = document.getElementById('filter_value');
    const dateInputs = document.getElementById('date_range_inputs');

    const options = {
        status: ['pending', 'in_transit', 'delivered', 'delayed', 'cancelled'],
        @foreach($ports as $port)
            origin_port_id: @json(@$ports->pluck('name', 'id')),
            destination_port_id: @json(@$ports->pluck('name', 'id')),
        @endforeach
        @foreach($ships as $ship)
            ship_id: @json(@$ships->pluck('name', 'id')),
        @endforeach
        @foreach($cargo as $c)
            cargo_id: @json(@$cargo->pluck('description', 'id')),
        @endforeach
    };

    filterType.addEventListener('change', function () {
        const selected = this.value;
        filterValue.innerHTML = '';

        if (!selected) {
            filterValueWrapper.classList.add('hidden');
            dateInputs.classList.add('hidden');
            return;
        }

        if (selected === 'date_range') {
            dateInputs.classList.remove('hidden');
            filterValueWrapper.classList.add('hidden');
        } else {
            dateInputs.classList.add('hidden');
            filterValueWrapper.classList.remove('hidden');

            let data = options[selected];
            for (const [key, value] of Object.entries(data)) {
                const option = document.createElement('option');
                option.value = key;
                option.text = value;
                filterValue.appendChild(option);
            }
        }
    });
</script>
@endpush
