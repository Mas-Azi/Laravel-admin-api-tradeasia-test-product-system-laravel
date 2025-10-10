<?php

// namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan sudah login
    }

    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();
        // $product = Product::all();
        // dd($product);
        return view('products.index', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_id' => 'required|string|max:255',
            'hs_code' => 'required|string|max:50',
            'cas_number' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_en' => 'required|string',
            'description_id' => 'required|string',
            'application_en' => 'nullable|string',
            'application_id' => 'nullable|string',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_id' => 'nullable|string|max:255',
            'meta_keyword_en' => 'nullable|string|max:255',
            'meta_keyword_id' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string',
            'meta_description_id' => 'nullable|string',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
        }

        Product::create([
            'name' => ['en' => $request->name_en, 'id' => $request->name_id],
            'hs_code' => $request->hs_code,
            'cas_number' => $request->cas_number,
            'image' => $imageName,
            'description' => ['en' => $request->description_en, 'id' => $request->description_id],
            'application' => ['en' => $request->application_en, 'id' => $request->application_id],
            'meta_title' => ['en' => $request->meta_title_en, 'id' => $request->meta_title_id],
            'meta_keyword' => ['en' => $request->meta_keyword_en, 'id' => $request->meta_keyword_id],
            'meta_description' => ['en' => $request->meta_description_en, 'id' => $request->meta_description_id],
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        // dump($product);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Ambil produk
        $product = Product::findOrFail($id);

        // Validasi request
        $request->validate([
            'name.en' => 'required|string|max:255',
            'name.id' => 'required|string|max:255',
            'hs_code' => 'nullable|string|max:50',
            'cas_number' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description.en' => 'nullable|string',
            'description.id' => 'nullable|string',
            'application.en' => 'nullable|string',
            'application.id' => 'nullable|string',
            'meta_title.en' => 'nullable|string',
            'meta_title.id' => 'nullable|string',
            'meta_keyword.en' => 'nullable|string',
            'meta_keyword.id' => 'nullable|string',
            'meta_description.en' => 'nullable|string',
            'meta_description.id' => 'nullable|string',
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('image')) {
            // Hapus file lama
            if ($product->image && file_exists(storage_path('app/public/products/' . $product->image))) {
                unlink(storage_path('app/public/products/' . $product->image));
            }

            // Simpan file baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);

            $product->image = $filename;
        }

        // Update field multi bahasa
        $product->name = $request->input('name'); // array ['en'=>..., 'id'=>...]
        $product->description = $request->input('description');
        $product->application = $request->input('application');
        $product->meta_title = $request->input('meta_title');
        $product->meta_keyword = $request->input('meta_keyword');
        $product->meta_description = $request->input('meta_description');

        // Update field lain
        $product->hs_code = $request->hs_code;
        $product->cas_number = $request->cas_number;

        // Simpan perubahan
        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }


    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar jika ada
        if ($product->image && file_exists(storage_path('app/public/products/' . $product->image))) {
            unlink(storage_path('app/public/products/' . $product->image));
        }

        // Hapus record dari database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
