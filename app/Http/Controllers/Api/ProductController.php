<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with('category')->get();
            return response()->json([
                'message' => 'Products retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan'
                ], 404);
            }

            // Optional: check user access using Policy, similar to normal controller
            if ($request->user()->cannot('update', $product)) {
                 return response()->json(['message' => 'Forbidden'], 403);
            }

            $validated = $request->validated();
            $product->update($validated);

            Log::info('Berhasil mengupdate produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Product berhasil diupdate',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat mengupdate produk', [
                'message' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan'
                ], 404);
            }

            // Optional: check user access using Policy
            if ($request->user()->cannot('delete', $product)) {
                 return response()->json(['message' => 'Forbidden'], 403);
            }

            $product->delete();

            Log::info('Berhasil menghapus produk', ['id' => $id]);

            return response()->json([
                'message' => 'Product berhasil dihapus'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat menghapus produk', [
                'message' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}
