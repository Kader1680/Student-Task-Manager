<script src="//unpkg.com/alpinejs" defer></script>

<nav class="bg-white shadow p-4 flex justify-between items-center">
    <a href="/" class="font-bold text-xl">AntiProc</a>
    <ul class="flex gap-6 items-center">

        @auth
            @if(auth()->user()->role === 'student')
                <li><a href="/calendar" class="text-green-600">My Calendar</a></li>
                <li><a href="/helps" class="text-green-600">All Helps</a></li>
                <li><a href="{{ route('projects.index') }}" class="hover:text-blue-600">Projects</a></li>

                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none">
                        <i class="fa-solid fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <ul
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg z-50"
                    >
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li class="p-2 border-b flex justify-between items-center">
                                <span class="text-sm text-gray-700">{{ $notification->data['message'] ?? 'Notification' }}</span>

                                <form action="{{ route('delete') }}" method="post" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $notification->id }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="p-2 text-gray-500 text-sm">No notifications</li>
                        @endforelse
                    </ul>
                </li>
            @endif

            {{-- Teacher Navigation --}}
            @if(auth()->user()->role === 'teacher')




<li><a href="/students
" class="text-blue-600">Tracking Student</a></li>

                <li><a href="/dashboard-teacher" class="text-yellow-600">Teacher Panel</a></li>
 <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none">
                        <i class="fa-solid fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    {{-- Dropdown --}}
                    <ul
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg z-50"
                    >
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li class="p-2 border-b flex justify-between items-center">
                                <span class="text-sm text-gray-700">{{ $notification->data['message'] ?? 'Notification' }}</span>

                                <form action="{{ route('delete') }}" method="post" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $notification->id }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="p-2 text-gray-500 text-sm">No notifications</li>
                        @endforelse
                    </ul>
                </li>

                <li><a href="/helps-teacher" class="text-green-600">All Helps</a></li>
            @endif

            <li><a href="{{ route('profile') }}" class="hover:text-blue-600">Profile</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav>
