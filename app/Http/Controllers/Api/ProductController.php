<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        if (! $request->user()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $search = $request->query('search');
        $perPage = 4;

        $products = Produk::with(['kategori', 'tempatproduk'])
            ->when($search, function ($query) use ($search) {
                // Remove extra spaces and special characters from search term
                $search = trim($search);

                return $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_produk) LIKE LOWER(?)', ["%{$search}%"])
                        ->orWhereRaw('LOWER(barcode_produk) LIKE LOWER(?)', ["%{$search}%"]);
                });
            })
            ->paginate($perPage);

        if (is_null($products)) {
            return $this->sendError('produk masih kosong');
        }

        return $this->sendResponse([
            'current_page' => $products->currentPage(),
            'data' => ProductResource::collection($products),
            'first_page_url' => $products->url(1),
            'from' => $products->firstItem(),
            'last_page' => $products->lastPage(),
            'last_page_url' => $products->url($products->lastPage()),
            'next_page_url' => $products->nextPageUrl(),
            'per_page' => $products->perPage(),
            'prev_page_url' => $products->previousPageUrl(),
            'to' => $products->lastItem(),
            'total' => $products->total(),
        ], 'berhasil mengambil data produk');
    }

    public function show(Request $request, $barcode_produk)
    {
        if (! $request->user()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $product = Produk::with(['kategori', 'tempatproduk'])->where('barcode_produk', $barcode_produk)->first();

        if (is_null($product)) {
            return $this->sendError('produk tidak di temukan.');
        }

        return $this->sendResponse(new ProductResource($product), 'produk telah ditemukan');
    }
}
