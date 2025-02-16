<x-app-admin-layout :assets="$assets ?? []">
    <x-card :header="isset($lead->id) ? 'Ubah Calon Pelanggan' : 'Calon Pelanggan Baru'" :action="route('admin.lead.index')" :id="$lead->id ?? null" :createdAt="$lead->created_at ?? null" :updatedAt="$lead->updated_at ?? null">
        <form method="POST"
            action="{{ isset($lead->id) ? route('admin.lead.update', $lead->id) : route('admin.lead.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($lead->id))
                @method('PUT')
            @endif
            <div class="row">
                <x-form-input name="name" id="name" label="Nama Calon Pelanggan"
                    placeholder="Masukkan Nama Calon Pelanggan" :value="$lead->name ?? ''" required="true" />
                <x-form-input name="email" id="email" label="Email Calon Pelanggan"
                    placeholder="Masukkan Email Calon Pelanggan" :value="$lead->email ?? ''" required="true" />
                <x-form-input name="phone_number" id="phone_number" label="Nomor Telepon Calon Pelanggan"
                    placeholder="Masukkan Nomor Telepon Calon Pelanggan" :value="$lead->phone_number ?? ''" required="true" />
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($lead->id) ? 'Ubah' : 'Tambah' }} Calon
                Pelanggan</button>
        </form>
    </x-card>
</x-app-admin-layout>
