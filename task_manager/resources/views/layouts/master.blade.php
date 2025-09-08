<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
    // ensure window.Echo exists (you configured Echo in your js files)
    window.Echo.channel('helps')
        .listen('HelpCreated', (e) => {
            console.log('New help:', e);
            const badge = document.getElementById('helps-count');
            if (badge) {
                badge.innerText = parseInt(badge.innerText || '0') + 1;
            }
        });
</script>


</body>
</html>
