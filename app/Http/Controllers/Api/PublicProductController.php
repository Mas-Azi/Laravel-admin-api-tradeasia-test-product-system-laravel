<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PublicProductController extends Controller
{
    // Ambil semua produk
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en'); // default en
        if (!in_array($lang, ['en', 'id'])) {
            return response()->json(['error' => 'Invalid language'], 400);
        }

        $products = Product::all()->map(function ($product) use ($lang) {
            return [
                'name' => $product->name[$lang] ?? $product->name['en'],
                'hs_code' => $product->hs_code,
                'cas_number' => $product->cas_number,
                'image_url' => $product->image ? asset('storage/products/' . $product->image) : null,
                'description' => $product->description[$lang] ?? $product->description['en'],
                'application' => $product->application[$lang] ?? $product->application['en'],
                'meta' => [
                    'meta_title' => $product->meta_title[$lang] ?? $product->meta_title['en'],
                    'meta_keyword' => $product->meta_keyword[$lang] ?? $product->meta_keyword['en'],
                    'meta_description' => $product->meta_description[$lang] ?? $product->meta_description['en'],
                ],
            ];
        });

        return response()->json($products);
    }

    // Ambil detail produk
    public function show(Request $request, $id)
    {

        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'id'])) {
            return response()->json(['error' => 'Invalid language'], 400);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $data = [
            'name' => $product->name[$lang] ?? $product->name['en'],
            'hs_code' => $product->hs_code,
            'cas_number' => $product->cas_number,
            'image_url' => $product->image ? asset('storage/products/' . $product->image) : null,
            'description' => $product->description[$lang] ?? $product->description['en'],
            'application' => $product->application[$lang] ?? $product->application['en'],
            'meta' => [
                'meta_title' => $product->meta_title[$lang] ?? $product->meta_title['en'],
                'meta_keyword' => $product->meta_keyword[$lang] ?? $product->meta_keyword['en'],
                'meta_description' => $product->meta_description[$lang] ?? $product->meta_description['en'],
            ],
        ];

        return response()->json($data);
    }
}
