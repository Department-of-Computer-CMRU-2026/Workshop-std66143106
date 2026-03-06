@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Registered Students: {{ $event->title }}</h1>
    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold mb-4 inline-block">← Back to Dashboard</a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden max-w-4xl mx-auto">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student Name</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email Address</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">{{ $index + 1 }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 font-bold whitespace-no-wrap">{{ $student->name }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">{{ $student->email }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm text-right">
                    <p class="text-gray-500 whitespace-no-wrap">{{ $student->pivot->created_at->format('M d, Y h:i A') }}</p>
                </td>
            </tr>
            @endforeach
            @if($students->isEmpty())
            <tr>
                <td colspan="4" class="px-5 py-5 border-b border-gray-200 text-sm text-center text-gray-500">
                    No students registered yet.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
