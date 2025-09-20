@extends('layouts.master')

@section('content')
<ul>
    @forelse($notifications as $notification)
        <li>
            {{ $notification->message }}
            @if(!$notification->is_read)
                <span class="text-red-500">• New</span>
            @endif
        </li>
    @empty
        <li>No notifications</li>
    @endforelse
</ul>

@endsection
