{{-- resources/views/terms.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Terms & Conditions') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-10 mx-auto">
        <h1 class="mb-6 text-3xl font-bold">Terms & Conditions</h1>

        <p class="mb-4">
            These Terms & Conditions govern the use of the services provided by Milestar Trade and Export Limited (“Milestar”), a Nigerian Limited Liability Company operating as a wheat brokerage firm.
        </p>

        <h2 class="mt-6 mb-2 text-xl font-semibold">1. Services</h2>
        <p class="mb-4">
            Milestar facilitates wheat trade between Russian suppliers and Nigerian buyers. We act solely as an intermediary and are not a direct supplier or buyer of wheat.
        </p>

        <h2 class="mt-6 mb-2 text-xl font-semibold">2. Commission Model</h2>
        <p class="mb-4">
            Milestar earns a fixed commission per ton of wheat successfully traded. This model ensures transparency and alignment of interests with both suppliers and buyers.
        </p>

        <h2 class="mt-6 mb-2 text-xl font-semibold">3. Liability</h2>
        <p class="mb-4">
            Milestar is not responsible for any disputes between buyers and suppliers but will support resolution efforts in good faith.
        </p>

        <h2 class="mt-6 mb-2 text-xl font-semibold">4. Compliance</h2>
        <p class="mb-4">
            All users of our service must comply with Nigerian and international trade laws. Milestar reserves the right to refuse service to parties that breach compliance standards.
        </p>

        <h2 class="mt-6 mb-2 text-xl font-semibold">5. Updates</h2>
        <p>
            These terms may be updated periodically. Continued use of our services constitutes acceptance of the revised terms.
        </p>
    </div>
</x-app-layout>
