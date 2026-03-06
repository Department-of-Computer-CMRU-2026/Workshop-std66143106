@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Upcoming Workshops</h1>
    <p class="mt-2 text-sm text-gray-600">You are registered for <span class="font-bold {{ $registrationCount >= 3 ? 'text-red-600' : 'text-green-600' }}">{{ $registrationCount }}</span> out of 3 maximum allowed events.</p>
    @if ($registrationCount >= 3)
        <div class="mt-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Registration Limit Reached</p>
            <p>You have registered for the maximum allowed number of events (3). You cannot register for any more.</p>
        </div>
    @endif
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $event)
        @php
            $isRegistered = in_array($event->id, $registeredEventIds);
            $remainingSeats = max(0, $event->total_seats - $event->users_count);
            $isFull = $remainingSeats <= 0;
            $canRegister = !$isRegistered && !$isFull && $registrationCount < 3;
        @endphp

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100 relative">
            @if($isRegistered)
                 <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                    Registered
                 </div>
            @elseif($isFull)
                 <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                    Closed
                 </div>
            @endif

            <div class="p-6">
                <h3 class="mt-2 text-xl font-bold text-gray-900">{{ $event->title }}</h3>
                <p class="mt-1 text-sm text-gray-500 mb-4 whitespace-nowrap overflow-hidden text-ellipsis">Speaker: <span class="font-semibold text-gray-700">{{ $event->speaker }}</span></p>

                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $event->location }}
                </div>

                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 {{ $isFull ? 'text-red-500' : 'text-green-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="{{ $isFull ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                        {{ $remainingSeats }} seats remaining
                    </span>
                    <span class="ml-1">({{ $event->users_count }}/{{ $event->total_seats }})</span>
                </div>

                @if($isRegistered)
                    <form action="{{ route('student.events.unregister', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                onclick="return confirm('Are you sure you want to cancel your registration for this event?');">
                            Cancel Registration
                        </button>
                    </form>
                @else
                    <form action="{{ route('student.events.register', $event) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white 
                                {{ $canRegister ? 'bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors' : 'bg-gray-400 cursor-not-allowed' }}"
                                {{ !$canRegister ? 'disabled' : '' }}>
                            @if($isFull)
                                Closed
                            @else
                                Register Now
                            @endif
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>

@if($events->isEmpty())
    <div class="text-center py-12">
        <h3 class="mt-2 text-sm font-medium text-gray-900">No events found</h3>
        <p class="mt-1 text-sm text-gray-500">There are currently no workshops available for registration.</p>
    </div>
@endif
@endsection
