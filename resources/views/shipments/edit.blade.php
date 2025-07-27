@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Shipment</h1>

    <form action="{{ route('shipments.update', $shipment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('shipments._form', ['shipment' => $shipment])

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Shipment</button>
            <a href="{{ route('shipments.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
