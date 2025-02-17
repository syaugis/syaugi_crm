@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<x-app-admin-layout :assets="['datatables']">
    @php
        $headerAction = [
            '<a href="' .
            route('admin.project.create') .
            '" class="btn btn-sm btn-primary" role="button">Tambahkan Proyek</a>',
            '<a href="' .
            route('admin.project.export') .
            '" class="btn btn-sm btn-success" role="button">Ekspor Proyek</a>',
        ];
    @endphp
    <x-data-table :pageTitle="'Data Proyek'" :headerAction="$headerAction ?? ''" :dataTable="$dataTable" />
</x-app-admin-layout>
