@extends('layouts.create')

@section('title', __('inbound.show_inbound'))

@section('subContent')

    <!-- Inbound Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold mb-4">{{ __('inbound.inbound_details') }}</h3>

            @if ($inbound['is_confirmed'] == 0)
                <!-- Only show if not confirmed -->
                <form action="{{ route('inbounds.confirm', $inbound['id']) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                        {{ __('messages.confirm') }}
                    </button>
                </form>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('inbound.reference_number') }}" :value="$inbound['reference_number']" />
            <x-key-value label="{{ __('inbound.supplier') }}" :value="$inbound['supplier']['name']" />
            <x-key-value label="{{ __('inbound.warehouse') }}" :value="$inbound['warehouse']['name']" />
            <x-key-value label="{{ __('inbound.received_date') }}" :value="$inbound['received_date']" />
            <x-key-value label="{{ __('inbound.invoice_number') }}" :value="$inbound['invoice_number']" />
            <x-key-value label="{{ __('inbound.is_confirmed') }}" :value="$inbound['is_confirmed']" />
            <x-key-value label="{{ __('messages.user') }}" :value="$inbound['created_by']['name']" />
        </div>
    </div>

    @php
// Define the columns with their type (text, image, link, or actions)
$columns = [
    ['key' => 'id', 'type' => 'text'],
    ['key' => 'product.name', 'type' => 'text'],
    ['key' => 'measurement_unit.abbreviation', 'type' => 'text'],
    ['key' => 'quantity', 'type' => 'text'],
    ['key' => 'unit_price', 'type' => 'text'],
];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('inbound.inbound_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('inbound.id') }}</x-table-header>
                <x-table-header>{{ __('inbound.name') }}</x-table-header>
                <x-table-header>{{ __('inbound.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('inbound.quantity') }}</x-table-header>
                <x-table-header>{{ __('inbound.unit_price') }}</x-table-header>

            </tr>
        </thead>
        <tbody>
            @if (!empty($inbound['inbound_items']))
                @foreach ($inbound['inbound_items'] as $inbound)
                    <x-table-row :data="$inbound" :columns="$columns" route="#" />
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    </div>
@endsection
