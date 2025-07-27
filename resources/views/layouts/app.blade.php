<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NaviCargo - @yield('title', 'DashBoard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-wide">

    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-800">NaviCargo</h1>
            <div class="space-x-4">
                <a href="{{ route('clients.index') }}" class="text-gray-700 hover:text-blue-600">Clients</a>
                <a href="{{ route('cargo.index') }}" class="text-gray-700 hover:text-blue-600">Cargo</a>
                <a href="{{ route('ships.index') }}" class="text-gray-700 hover:text-blue-600">Ships</a>
                <a href="{{ route('ports.index') }}" class="text-gray-700 hover:text-blue-600">Ports</a>
                <a href="{{ route('shipments.index') }}" class="text-gray-700 hover:text-blue-600">Shipments</a>
            </div>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="container mx-auto mt-10 px-4">
        <!-- Flash Messages -->
         @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm mt-10 mb-5">
        &copy; {{ now()->year }} NaviCargo. All rights reserved.
    </footer>

    @stack('scripts')
</body>
</html>