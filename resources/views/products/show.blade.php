@extends('layouts.app')

{{-- @section('title', 'Show Product') --}}

@section('contents')
    <div class="container">
        <h1 class="mb-3">Detail Product</h1>
        <hr />

        <!-- Name -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Name (EN)</label>
                <input type="text" class="form-control" value="{{ $product->name['en'] ?? '-' }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Name (ID)</label>
                <input type="text" class="form-control" value="{{ $product->name['id'] ?? '-' }}" readonly>
            </div>
        </div>

        <!-- HS Code & CAS Number -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">HS Code</label>
                <input type="text" class="form-control" value="{{ $product->hs_code }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">CAS Number</label>
                <input type="text" class="form-control" value="{{ $product->cas_number ?? '-' }}" readonly>
            </div>
        </div>

        <!-- Image -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Image</label>
                <div>
                    @if ($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image"
                            class="img-thumbnail" width="150">
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Description (EN)</label>
                <textarea class="form-control" rows="3" readonly>{{ $product->description['en'] ?? '-' }}</textarea>
            </div>
            <div class="col">
                <label class="form-label">Description (ID)</label>
                <textarea class="form-control" rows="3" readonly>{{ $product->description['id'] ?? '-' }}</textarea>
            </div>
        </div>

        <!-- Application -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Application (EN)</label>
                <textarea class="form-control" rows="2" readonly>{{ $product->application['en'] ?? '-' }}</textarea>
            </div>
            <div class="col">
                <label class="form-label">Application (ID)</label>
                <textarea class="form-control" rows="2" readonly>{{ $product->application['id'] ?? '-' }}</textarea>
            </div>
        </div>

        <!-- Meta SEO -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Meta Title (EN)</label>
                <input type="text" class="form-control" value="{{ $product->meta_title['en'] ?? '-' }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Meta Title (ID)</label>
                <input type="text" class="form-control" value="{{ $product->meta_title['id'] ?? '-' }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Meta Keyword (EN)</label>
                <input type="text" class="form-control" value="{{ $product->meta_keyword['en'] ?? '-' }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Meta Keyword (ID)</label>
                <input type="text" class="form-control" value="{{ $product->meta_keyword['id'] ?? '-' }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Meta Description (EN)</label>
                <textarea class="form-control" rows="2" readonly>{{ $product->meta_description['en'] ?? '-' }}</textarea>
            </div>
            <div class="col">
                <label class="form-label">Meta Description (ID)</label>
                <textarea class="form-control" rows="2" readonly>{{ $product->meta_description['id'] ?? '-' }}</textarea>
            </div>
        </div>

        <!-- Created & Updated At -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Created At</label>
                <input type="text" class="form-control" value="{{ $product->created_at }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Updated At</label>
                <input type="text" class="form-control" value="{{ $product->updated_at }}" readonly>
            </div>
        </div>
    </div>
@endsection
