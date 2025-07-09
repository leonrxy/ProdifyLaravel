<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_start' => 'nullable|date',
            'display_end' => 'nullable|date',
            'status' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $photoPath = $request->file('photo')->store('products', 'public');

        $data = $request->only([
            'name',
            'description',
            'price',
            'display_start',
            'display_end',
            'status',
            'stock'
        ]);

        $data['photo_url'] = $photoPath;
        $data['admin_id'] = Auth::id();

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_start' => 'nullable|date',
            'display_end' => 'nullable|date',
            'status' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($product->photo_url && Storage::disk('public')->exists($product->photo_url)) {
                Storage::disk('public')->delete($product->photo_url);
            }
            $photoPath = $request->file('photo')->store('products', 'public');
            $data['photo_url'] = $photoPath;
        }
        $data['admin_id'] = Auth::id();
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->photo_url && Storage::disk('public')->exists($product->photo_url)) {
            Storage::disk('public')->delete($product->photo_url);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
