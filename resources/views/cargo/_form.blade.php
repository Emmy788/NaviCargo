<div class="mb-4">

    <label for="description" class="block font-medium">Description <span class="text-red-500">*</span></label>
    <textarea name="description" id="description" required
        class="w-full p-2 border rounded">{{ old('description', $cargo->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label for="weight" class="block font-medium">Weight (kg) <span class="text-red-500">*</span></label>
    <input type="number" name="weight" id="weight" step="0.01" min="0.01" required
        value="{{ old('weight', $cargo->weight ?? '') }}"
        class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label for="volume" class="block font-medium">Volume (m³)</label>
    <input type="number" name="volume" id="volume" step="0.01" min="0"
        value="{{ old('volume', $cargo->volume ?? '') }}"
        class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label for="cargo_type" class="block font-medium">Cargo Type</label>
    <select name="cargo_type" id="cargo_type" class="w-full p-2 border rounded">
        <option value="general" {{ old('cargo_type', $cargo->cargo_type ?? 'general') === 'general' ? 'selected' : '' }}>General</option>
        <option value="perishable" {{ old('cargo_type', $cargo->cargo_type ?? '') === 'perishable' ? 'selected' : '' }}>Perishable</option>
        <option value="dangerous" {{ old('cargo_type', $cargo->cargo_type ?? '') === 'dangerous' ? 'selected' : '' }}>Dangerous</option>
        <option value="other" {{ old('cargo_type', $cargo->cargo_type ?? '') === 'other' ? 'selected' : '' }}>Other</option>
    </select>
</div>
<div class="mb-4">
    <label for="client_id" class="block font-medium">Client <span class="text-red-500">*</span></label>
    <select name="client_id" id="client_id" required class="w-full mt-1 p-2 border rounded">
        <option value="">-- Select Client --</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}"
                {{ old('client_id', $cargo->client_id ?? '') == $client->id ? 'selected' : '' }}>
                {{ $client->company_name }}
            </option>
        @endforeach
    </select>
</div>


@if(isset($cargo))
    <div class="mb-4">
        <label for="is_active" class="inline-flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active', $cargo->is_active) ? 'checked' : '' }}
                class="mr-2">
            Active
        </label>
    </div>
@endif
