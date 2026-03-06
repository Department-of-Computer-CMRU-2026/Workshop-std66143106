@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-sm mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Register as Student</h2>

    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password" type="password" name="password" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
            <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password_confirmation" type="password" name="password_confirmation" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full transition transform hover:scale-105" type="submit">
                Register
            </button>
        </div>
        <div class="mt-4 text-center">
            <a class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('login') }}">
                Already have an account? Login
            </a>
        </div>
    </form>
</div>
@endsection
