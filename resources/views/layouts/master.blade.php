<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js'></script>


</head>
<body class="flex flex-col min-h-screen bg-gray-100">

     @include('layouts.navbar')

     <main class="flex-1 container mx-auto p-4">
        @yield('content')
    </main>

     @include('layouts.footer')



<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script> {{-- your Laravel Echo config --}}

<script>
document.addEventListener("DOMContentLoaded", () => {
    const notificationBtn = document.getElementById("notification-btn");
    const notificationDropdown = document.getElementById("notification-dropdown");
    const notificationList = document.getElementById("notification-list");
    const notificationCount = document.getElementById("notification-count");

    let count = 0;

    // Toggle dropdown
    notificationBtn?.addEventListener("click", () => {
        notificationDropdown.classList.toggle("hidden");
    });

    // Listen for Laravel events
    window.Echo.channel("helps")
        .listen(".help.created", (e) => {
            addNotification(`🆘 New help request for task #${e.help.task_id}`);
        })
        .listen(".help.replied", (e) => {
            addNotification(`✅ Teacher replied to task #${e.help.task_id}`);
        });

    function addNotification(message) {
        count++;
        notificationCount.textContent = count;
        notificationCount.classList.remove("hidden");

        // If "No notifications yet" exists, remove it
        if (notificationList.children.length === 1 &&
            notificationList.children[0].textContent === "No notifications yet") {
            notificationList.innerHTML = "";
        }

        // Add new notification
        const li = document.createElement("li");
        li.className = "p-3 border-b border-gray-200 text-sm hover:bg-gray-100 cursor-pointer";
        li.textContent = message;
        notificationList.prepend(li);
    }
});
</script>


</body>
</html>
