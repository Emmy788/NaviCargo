@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Create Shipment</h1>

    <form action="{{ route('shipments.store') }}" method="POST" class="space-y-4">
        @csrf

        @include('shipments._form', ['shipment' => null])

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Shipment</button>
    </form>
</div>
@endsection
