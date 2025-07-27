<div>
    <label for="cargo_id" class="block font-medium">Cargo <span class="text-red-500">*</span></label>
    <select name="cargo_id" id="cargo_id" class="w-full mt-1 p-2 border rounded" required>
        <option value="">-- Select Cargo --</option>
        @foreach($cargo as $item)
            <option value="{{ $item->id }}" {{ old('cargo_id', optional($shipment)->cargo_id) == $item->id ? 'selected' : '' }}>
                {{ $item->description }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="ship_id" class="block font-medium">Ship <span class="text-red-500">*</span></label>
    <select name="ship_id" id="ship_id" class="w-full mt-1 p-2 border rounded" required>
        <option value="">-- Select Ship --</option>
        @foreach($ships as $ship)
            <option value="{{ $ship->id }}" {{ old('ship_id', optional($shipment)->ship_id) == $ship->id ? 'selected' : '' }}>
                {{ $ship->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="origin_port_id" class="block font-medium">Origin Port</label>
        <select name="origin_port_id" id="origin_port_id" class="w-full mt-1 p-2 border rounded">
            <option value="">-- Select Origin --</option>
            @foreach($ports as $port)
                <option value="{{ $port->id }}" {{ old('origin_port_id', optional($shipment)->origin_port_id) == $port->id ? 'selected' : '' }}>
                    {{ $port->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="destination_port_id" class="block font-medium">Destination Port</label>
        <select name="destination_port_id" id="destination_port_id" class="w-full mt-1 p-2 border rounded">
            <option value="">-- Select Destination --</option>
            @foreach($ports as $port)
                <option value="{{ $port->id }}" {{ old('destination_port_id', optional($shipment)->destination_port_id) == $port->id ? 'selected' : '' }}>
                    {{ $port->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="departure_date" class="block font-medium">Departure Date</label>
        <input type="date" name="departure_date" id="departure_date"
               class="w-full mt-1 p-2 border rounded"
               value="{{ old('departure_date', optional($shipment)->departure_date) }}">
    </div>

    <div>
        <label for="arrival_estimate" class="block font-medium">Estimated Arrival</label>
        <input type="date" name="arrival_estimate" id="arrival_estimate"
               class="w-full mt-1 p-2 border rounded"
               value="{{ old('arrival_estimate', optional($shipment)->arrival_estimate) }}">
    </div>
</div>

<div>
    <label for="status" class="block font-medium">Status</label>
    <select name="status" id="status" class="w-full mt-1 p-2 border rounded">
        @foreach(['pending', 'in_transit', 'delivered', 'delayed'] as $status)
            <option value="{{ $status }}" {{ old('status', optional($shipment)->status) == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>
