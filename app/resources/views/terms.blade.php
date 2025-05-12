{{-- resources/views/terms.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Terms & Conditions') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-10 mx-auto text-gray-900 bg-white rounded shadow">
        <p class="mb-4">
            These Terms & Conditions govern the use of the services provided by Milestar Trade and Export Limited (“Milestar”), a Nigerian Limited Liability Company operating as an agricultural crops brokerage and trade firm.
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">1. Services</h3>
        <p class="mb-4">
            Milestar facilitates wheat trade between Russian suppliers and Nigerian buyers. We act solely as an intermediary and are not a direct supplier or buyer of wheat.
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">2. Commission Model</h3>
        <p class="mb-4">
            Milestar earns a fixed commission per ton of wheat successfully traded. This model ensures transparency and alignment of interests with both suppliers and buyers.
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">3. Liability</h3>
        <p class="mb-4">
            Milestar is not responsible for any disputes between buyers and suppliers but will support resolution efforts in good faith.
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">4. Compliance</h3>
        <p class="mb-4">
            All users of our service must comply with Nigerian and international trade laws. Milestar reserves the right to refuse service to parties that breach compliance standards.
        </p>

        <h3 class="mt-6 mb-2 text-lg font-semibold">5. Updates</h3>
        <p>
            These terms may be updated periodically. Continued use of our services constitutes acceptance of the revised terms.
        </p>
    </div>
</x-app-layout>
