<nav class="bg-white shadow p-4 flex justify-between">
    <a href="/" class="font-bold text-xl">{{ config('app.name') }}</a>
    <ul class="flex gap-4">
        <li><a href="{{ route('projects.index') }}" class="hover:text-blue-600">Projects</a></li>


        @if(isset($project))
            <a href="{{ route('projects.tasks.index', $project->id) }}" class="text-blue-500">View Tasks</a>
        @endif



        @auth
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
