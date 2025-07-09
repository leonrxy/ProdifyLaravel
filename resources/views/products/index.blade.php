@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Daftar Produk</h1>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Harga
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Foto
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $index => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                  {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <img src="{{ asset('storage/' . $product->photo_url) }}" alt="Foto {{ $product->name }}"
                                    class="inline-block h-12 w-12 rounded-full object-cover border">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('products.edit', $product) }}"
                                    class="text-blue-600 hover:text-blue-800 mx-1" title="Edit">
                                    ✏️
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $product->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 mx-1" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
