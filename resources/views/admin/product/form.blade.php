<x-app-admin-layout :assets="$assets ?? []">
    <x-card :header="isset($product->id) ? 'Ubah Produk' : 'Produk Baru'" :action="route('admin.product.index')" :id="$product->id ?? null" :createdAt="$product->created_at ?? null" :updatedAt="$product->updated_at ?? null">
        <form method="POST"
            action="{{ isset($product->id) ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($product->id))
                @method('PUT')
            @endif
            <div class="row">
                <x-form-input name="name" id="name" label="Nama Produk" placeholder="Masukkan Nama Produk"
                    :value="$product->name ?? ''" required="true" />
                <x-form-input name="description" id="description" label="Deskripsi Produk"
                    placeholder="Masukkan Deskripsi Produk" :value="$product->description ?? ''" />
                <x-form-input name="price" id="price" label="Harga Produk" placeholder="Masukkan Harga Produk"
                    :value="$product->price ?? ''" required="true" />
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($product->id) ? 'Ubah' : 'Tambah' }} Produk</button>
        </form>
    </x-card>
</x-app-admin-layout>
