<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main Content --}}
    <main class="flex-1 container mx-auto p-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
