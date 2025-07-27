@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <!-- Page Title -->
     <div class="w-full flex justify-center">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-10">All Shipments</h2>
    </div>

    <!-- Filter + Button Row -->
<div class="flex justify-between items-start mb-6 gap-4 flex-wrap">
    
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
    <a href="{{ route('shipments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded h-fit mt-6">Add Shipment</a>
</div>



    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Cargo</th>
                <th>Ship</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Departure</th>
                <th>Arrival Estimate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($shipments as $shipment)
            <tr>
                <td class="p-2">{{ $shipment->cargo->description ?? 'N/A' }}</td>
                <td>{{ $shipment->ship->name ?? 'N/A' }}</td>
                <td>{{ $shipment->originPort->name ?? 'N/A' }}</td>
                <td>{{ $shipment->destinationPort->name ?? 'N/A' }}</td>
                <td>{{ ucfirst($shipment->status) }}</td>
                <td>{{ $shipment->departure_date }}</td>
                <td>{{ $shipment->arrival_estimate }}</td>
                <td>
                    <a href="{{ route('shipments.edit', $shipment->id) }}" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

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
