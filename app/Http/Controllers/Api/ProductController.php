<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    //
    public function show(Request $request, $barcode_produk)
    {
        // Ensure the user is authenticated
        if (!$request->user()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $product = Produk::with(['kategori', 'tempatproduk'])->where('barcode_produk', $barcode_produk)->first();

        if (is_null($product)) {
            return $this->sendError('produk tidak di temukan.');
        }

        return $this->sendResponse(new ProductResource($product), 'produk telah ditemukan');
    }
}
