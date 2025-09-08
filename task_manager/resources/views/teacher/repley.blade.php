@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
 	<form action="{{route("helps-teacher.reply", $help->id)}}" method="POST" class="space-y-4"  >
            @csrf
            @method('PUT')

            <div>
                <label for="response" class="mb-1 block text-sm font-medium">Repley Message</label>
                <textarea name="response" rows="4" class="w-full rounded-xl border px-3 py-2 focus:outline-none focus:ring" placeholder="Your Repley or Answer"></textarea>
            </div>

            <button type="submit" class="w-full rounded-2xl bg-sky-600 px-4 py-2 font-medium text-white shadow hover:bg-sky-700">Submit Review</button>
        </form>
</div>
@endsection
