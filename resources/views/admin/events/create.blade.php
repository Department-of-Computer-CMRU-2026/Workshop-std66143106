@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Create New Event</h2>
        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Back</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.events.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Event Title</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="title" type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="speaker">Speaker</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="speaker" type="text" name="speaker" value="{{ old('speaker') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="location" type="text" name="location" value="{{ old('location') }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="total_seats">Total Seats</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="total_seats" type="number" name="total_seats" min="1" value="{{ old('total_seats') }}" required>
        </div>
        <div class="flex items-center">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="submit">
                Save Event
            </button>
        </div>
    </form>
</div>
@endsection
