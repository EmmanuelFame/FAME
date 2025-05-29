<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.privacy_policy') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-10 mx-auto text-gray-900 bg-white rounded shadow">
        <p class="mb-4">
            {{ __('messages.intro') }}
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section1') }}</h3>
        <p class="mb-4">{{ __('messages.section1_content') }}</p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section2') }}</h3>
        <p class="mb-4">{{ __('messages.section2_content') }}</p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section3') }}</h3>
        <p class="mb-4">{{ __('messages.section3_content') }}</p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section4') }}</h3>
        <p class="mb-4">{{ __('messages.section4_content') }}</p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section5') }}</h3>
        <p class="mb-4">{{ __('messages.section5_content') }}</p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">{{ __('messages.section6') }}</h3>
        <p>{{ __('messages.section6_content') }}</p>
    </div>
</x-app-layout>
