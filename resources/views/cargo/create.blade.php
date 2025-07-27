@extends('layouts.app')

@section('content')
<!-- <div class="container max-w-3xl mx-auto p-4"> -->
<div class="min-h-screen flex items-center justify-center py-10">
    <div class="w-full max-w-3xl bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-4">Add New Cargo</h1>

        <form action="{{ route('cargo.store') }}" method="POST" class="space-y-6">
            @csrf

            @include('cargo._form', ['clients' => $clients])

            <div class="flex justify-between items-center">

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                    Save Cargo
                </button>
                
                <a href="{{ route('cargo.index') }}"
                    class="text-gray-600 hover:text-gray-800 border border-gray-300 px-4 py-2 rounded">
                    Cancel
                </a>
            </div>

        </form>
    </div>    
</div>
@endsection
