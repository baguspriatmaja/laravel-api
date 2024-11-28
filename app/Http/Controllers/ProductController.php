<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller          
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $products = Product::with(['category','brand']);

        if($keyword) {
            $products = $products->where('name', 'like', "%{$keyword}%");
        }

        if($categoryId) {
            $products = $products->where('category_id', $categoryId);
        }

        $products = $products->orderBy('name', 'asc')->paginate(5);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer']
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Nama category wajib diisi.',
            'brand_id.required' => 'Nama brand wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
        ]);

        $products = Product::create($validatedData);
        return response()->json([
            'message' => 'Produk berhasil disimpan',
            'product' => $products
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json(['message' => 'Produk berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    }
}
