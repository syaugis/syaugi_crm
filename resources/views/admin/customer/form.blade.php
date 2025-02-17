@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<x-app-admin-layout :assets="$assets ?? []">
    <div class="row">
        <x-card header="Detail Pelanggan" :action="route('admin.customer.index')" :id="$customer->id ?? null" :createdAt="$customer->created_at ?? null" :updatedAt="$customer->updated_at ?? null">
            <div class="row">
                <x-form-input name="name" id="name" label="Nama Pelanggan" :value="$customer->name ?? ''" :readonly="true" />
                <x-form-input name="email" id="email" label="Email Pelanggan" :value="$customer->email ?? ''" :readonly="true" />
                <x-form-input name="phone_number" id="phone_number" label="Nomor Telepon Pelanggan" :value="$customer->phone_number ?? ''"
                    :readonly="true" />
            </div>
        </x-card>
    </div>

    <div class="row">
        <x-data-table pageTitle="Daftar Produk" :dataTable="$dataTable" />
    </div>
</x-app-admin-layout>
