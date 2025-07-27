@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
    <div class="w-full flex justify-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8">Edit Client</h2>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('clients.update', $client) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- First Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                <input type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('first_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Last Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                <input type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('last_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Address --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input type="email" name="email_address" value="{{ old('email_address', $client->email_address) }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email_address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Address</label>
                <textarea name="address" rows="3"
                          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $client->address) }}</textarea>
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Update Client
                </button>
            </div>
        </form>
    </div>
@endsection
