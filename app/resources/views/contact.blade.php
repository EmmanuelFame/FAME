@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-xl px-4 py-10 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Contact Us</h1>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-1 font-medium" for="name">Name</label>
            <input type="text" name="name" id="name" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="email">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="message">Message</label>
            <textarea name="message" id="message" rows="4" required
                      class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"></textarea>
        </div>

        <button type="submit"
                class="px-5 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
            Send Message
        </button>
    </form>
</div>
@endsection
