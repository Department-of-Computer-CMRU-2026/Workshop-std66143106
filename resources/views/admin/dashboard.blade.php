@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    <a href="{{ route('admin.events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
        + Create New Event
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Event Title</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Speaker</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Location</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Seats (Reg/Total)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 font-bold whitespace-no-wrap">{{ $event->title }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">{{ $event->speaker }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">{{ $event->location }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <div class="flex items-center">
                        <span class="relative inline-block px-3 py-1 font-semibold {{ $event->users_count >= $event->total_seats ? 'text-red-900' : 'text-green-900' }} leading-tight">
                            <span aria-hidden class="absolute inset-0 {{ $event->users_count >= $event->total_seats ? 'bg-red-200' : 'bg-green-200' }} opacity-50 rounded-full"></span>
                            <span class="relative">{{ $event->users_count }} / {{ $event->total_seats }}</span>
                        </span>
                    </div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm text-center">
                    <a href="{{ route('admin.events.students', $event) }}" class="text-blue-600 hover:text-blue-900 mr-3">View Students</a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($events->isEmpty())
            <tr>
                <td colspan="5" class="px-5 py-5 border-b border-gray-200 text-sm text-center text-gray-500">
                    No events found.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
