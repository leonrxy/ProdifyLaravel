@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                {{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}
            </h1>
            <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline text-sm">← Kembali ke Daftar</a>
        </div>

        <form method="POST" enctype="multipart/form-data"
            action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" class="space-y-6">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div>
                <label class="input-label">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="input-field">
                @error('name')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="input-label">Deskripsi</label>
                <textarea name="description" rows="4" class="input-field">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label">Harga</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price ?? '') }}"
                        class="input-field">
                    @error('price')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="input-label">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
                        class="input-field">
                    @error('stock')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label">Tampil Mulai</label>
                    <input type="date" name="display_start"
                        value="{{ old('display_start', isset($product->display_start) ? \Carbon\Carbon::parse($product->display_start)->format('Y-m-d') : '') }}"
                        class="input-field">
                    @error('display_start')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="input-label">Tampil Hingga</label>
                    <input type="date" name="display_end"
                        value="{{ old('display_end', isset($product->display_end) ? \Carbon\Carbon::parse($product->display_end)->format('Y-m-d') : '') }}"
                        class="input-field">
                    @error('display_end')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="input-label">Status</label>
                <select name="status" class="select-field">
                    <option value="draft" {{ old('status', $product->status ?? '') === 'draft' ? 'selected' : '' }}>
                        Draft</option>
                    <option value="active" {{ old('status', $product->status ?? '') === 'active' ? 'selected' : '' }}>
                        Active</option>
                    <option value="archived"{{ old('status', $product->status ?? '') === 'archived' ? 'selected' : '' }}>
                        Archived</option>
                </select>
                @error('status')
                    <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="input-label">Foto Produk</label>
                <input type="file" name="photo"
                    class="mt-1 block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700
                      hover:file:bg-blue-100">
                @if (isset($product) && $product->photo_url)
                    <img src="{{ asset('storage/' . $product->photo_url) }}" alt="Preview Foto"
                        class="mt-4 h-32 w-32 object-cover rounded-lg border">
                @endif
                @error('photo')
                    <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full inline-flex justify-center py-2 px-4
                       bg-blue-600 hover:bg-blue-700 text-white font-medium
                       rounded-md shadow focus:outline-none focus:ring focus:ring-blue-200">
                    {{ isset($product) ? 'Update Produk' : 'Simpan Produk' }}
                </button>
            </div>
        </form>
    </div>
@endsection
