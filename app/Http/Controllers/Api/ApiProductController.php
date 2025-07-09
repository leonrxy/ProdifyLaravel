<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $products = $query->paginate(10);
        return $this->successResponse($products, 'Product list');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse($product, 'Product retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|in:active,draft,inactive',
            'stock' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = $request->file('photo')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'stock' => $request->stock,
            'photo_url' => Storage::url($photoPath),
            'admin' => $request->admin,
            'display_start' => $request->display_start,
            'display_end' => $request->display_end,
        ]);

        return $this->successResponse($product, 'Product created successfully', 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string|in:active,draft,inactive',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo_url) {
                $photoPath = str_replace('/storage/', '', $product->photo_url);
                Storage::delete($photoPath);
            }

            $photoPath = $request->file('photo')->store('products', 'public');
            $product->photo_url = Storage::url($photoPath);
        }

        $product->update($request->except(['photo']));

        return $this->successResponse($product, 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        if ($product->photo_url) {
            $photoPath = str_replace('/storage/', '', $product->photo_url);
            Storage::delete($photoPath);
        }

        $product->delete();

        return $this->successResponse(null, 'Product deleted successfully');
    }
}
