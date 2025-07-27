@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Cargo</h1>

    <form action="{{ route('cargo.update', $cargo->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('cargo._form', ['cargo' => $cargo, 'clients' => $clients])

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Cargo</button>
            <a href="{{ route('cargo.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
