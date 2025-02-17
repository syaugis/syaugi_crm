@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<x-app-admin-layout :assets="['datatables']">
    @php
        $headerAction = [
            '<a href="' .
            route('admin.customer.export') .
            '" class="btn btn-sm btn-success" role="button">Ekspor Pelanggan</a>',
        ];
    @endphp
    <x-data-table :pageTitle="'Data Pelanggan'" :headerAction="$headerAction ?? ''" :dataTable="$dataTable" />
</x-app-admin-layout>
