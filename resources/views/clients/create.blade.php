@extends('layouts.app')

@section('title', 'Add Client')

@section('content')
    <div class="w-full flex justify-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8">Add Client</h2>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('clients.store') }}" class="space-y-5">
            @csrf

            <!-- Company Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="company_name">Company Name <span class="text-red-500">*</span></label>
                <input type="text" name="company_name" placeholder="e.g. Global Freight Co." value="{{ old('company_name', $client->company_name ?? '') }}" 
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Contact Person (First & Last Name) -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Contact Person <span class="text-red-500">*</span></label>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- First Name -->
                    <div class="flex-1">
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            placeholder="First Name"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('first_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="flex-1">
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            placeholder="Last Name"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('last_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <!-- Email Address -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input type="email" name="email_address" placeholder="e.g. contact@company.com" value="{{ old('email_address') }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email_address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input 
                    type="tel" 
                    name="phone_number" 
                    placeholder="e.g. +254 xxx xxx xxx" 
                    maxlength="15"
                    pattern="\+?[0-9]{1,15}" 
                    value="{{ old('phone_number') }}"
                    inputmode="numeric"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Address</label>
                <textarea name="address" rows="3" placeholder="e.g. 123 Mombasa Road, Nairobi, Kenya" autocomplete="street-address" spellcheck="true"
                          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Save Client
                </button>
            </div>
        </form>
    </div>
@endsection
