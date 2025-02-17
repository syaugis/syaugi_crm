<x-app-admin-layout :assets="$assets ?? []">
    <x-card :header="isset($project->id) ? 'Ubah Proyek' : 'Proyek Baru'" :action="route('admin.project.index')" :id="$project->id ?? null" :createdAt="$project->created_at ?? null" :updatedAt="$project->updated_at ?? null">
        <form method="POST"
            action="{{ isset($project->id) ? route('admin.project.update', $project->id) : route('admin.project.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($project->id))
                @method('PUT')
            @endif
            <div class="row">
                <x-select name="lead_id" label="Nama Pelanggan" :options="$leads" :selected="$project->lead_id ?? ''" required="true" />
                <x-select name="product_id" label="Produk" :options="$products" :selected="$project->product_id ?? ''" required="true" />
                @if (isset($project->id))
                    <x-select name="status" label="Status" :options="$statuses" :selected="$project->status ?? ''" required="true" />
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($project->id) ? 'Ubah' : 'Tambah' }} Proyek</button>
        </form>
    </x-card>
</x-app-admin-layout>
