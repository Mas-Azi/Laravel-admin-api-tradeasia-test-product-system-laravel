@extends('layouts.app')

{{-- @section('title', 'Edit Product') --}}

@section('contents')
    <div class="container">
        <h1 class="mb-3">Edit Product</h1>
        <hr />

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Name (EN)</label>
                    <input type="text" name="name[en]" class="form-control" value="{{ $product->name['en'] ?? '' }}">
                </div>
                <div class="col">
                    <label class="form-label">Name (ID)</label>
                    <input type="text" name="name[id]" class="form-control" value="{{ $product->name['id'] ?? '' }}">
                </div>
            </div>

            <!-- HS Code & CAS Number -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">HS Code</label>
                    <input type="text" name="hs_code" class="form-control" value="{{ $product->hs_code }}">
                </div>
                <div class="col">
                    <label class="form-label">CAS Number</label>
                    <input type="text" name="cas_number" class="form-control" value="{{ $product->cas_number }}">
                </div>
            </div>

            <!-- Image -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if ($product->image)
                        <img src="{{ asset('storage/products/' . urlencode($product->image)) }}" alt="Current Image"
                            class="img-thumbnail mt-2" width="150">
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Description (EN)</label>
                    <textarea class="form-control" name="description[en]" rows="3">{{ $product->description['en'] ?? '' }}</textarea>
                </div>
                <div class="col">
                    <label class="form-label">Description (ID)</label>
                    <textarea class="form-control" name="description[id]" rows="3">{{ $product->description['id'] ?? '' }}</textarea>
                </div>
            </div>

            <!-- Application -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Application (EN)</label>
                    <textarea class="form-control" name="application[en]" rows="2">{{ $product->application['en'] ?? '' }}</textarea>
                </div>
                <div class="col">
                    <label class="form-label">Application (ID)</label>
                    <textarea class="form-control" name="application[id]" rows="2">{{ $product->application['id'] ?? '' }}</textarea>
                </div>
            </div>

            <!-- Meta SEO -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Meta Title (EN)</label>
                    <input type="text" name="meta_title[en]" class="form-control"
                        value="{{ $product->meta_title['en'] ?? '' }}">
                </div>
                <div class="col">
                    <label class="form-label">Meta Title (ID)</label>
                    <input type="text" name="meta_title[id]" class="form-control"
                        value="{{ $product->meta_title['id'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Meta Keyword (EN)</label>
                    <input type="text" name="meta_keyword[en]" class="form-control"
                        value="{{ $product->meta_keyword['en'] ?? '' }}">
                </div>
                <div class="col">
                    <label class="form-label">Meta Keyword (ID)</label>
                    <input type="text" name="meta_keyword[id]" class="form-control"
                        value="{{ $product->meta_keyword['id'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Meta Description (EN)</label>
                    <textarea class="form-control" name="meta_description[en]" rows="2">{{ $product->meta_description['en'] ?? '' }}</textarea>
                </div>
                <div class="col">
                    <label class="form-label">Meta Description (ID)</label>
                    <textarea class="form-control" name="meta_description[id]" rows="2">{{ $product->meta_description['id'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-warning">Update Product</button>
                </div>
            </div>
        </form>
    </div>
@endsection
