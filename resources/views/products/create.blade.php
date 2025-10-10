@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
    <div class="container">
        <h1 class="mb-4">Add Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name EN & ID -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Name (EN)</label>
                    <input type="text" name="name_en" class="form-control" placeholder="Name in English"
                        value="{{ old('name_en') }}" required>
                </div>
                <div class="col-md-6">
                    <label>Name (ID)</label>
                    <input type="text" name="name_id" class="form-control" placeholder="Name in Indonesian"
                        value="{{ old('name_id') }}" required>
                </div>
            </div>

            <!-- HS Code & CAS Number -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>HS Code</label>
                    <input type="text" name="hs_code" class="form-control" placeholder="HS Code"
                        value="{{ old('hs_code') }}" required>
                </div>
                <div class="col-md-6">
                    <label>CAS Number</label>
                    <input type="text" name="cas_number" class="form-control" placeholder="CAS Number"
                        value="{{ old('cas_number') }}">
                </div>
            </div>

            <!-- Image Upload -->
            <div class="row mb-3">
                <div class="col">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <!-- Description EN & ID -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Description (EN)</label>
                    <textarea name="description_en" class="form-control" rows="3" placeholder="Description in English" required>{{ old('description_en') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>Description (ID)</label>
                    <textarea name="description_id" class="form-control" rows="3" placeholder="Description in Indonesian" required>{{ old('description_id') }}</textarea>
                </div>
            </div>

            <!-- Application EN & ID -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Application (EN)</label>
                    <textarea name="application_en" class="form-control" rows="2" placeholder="Application in English">{{ old('application_en') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>Application (ID)</label>
                    <textarea name="application_id" class="form-control" rows="2" placeholder="Application in Indonesian">{{ old('application_id') }}</textarea>
                </div>
            </div>

            <!-- Meta SEO Fields -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Meta Title (EN)</label>
                    <input type="text" name="meta_title_en" class="form-control" placeholder="Meta Title English"
                        value="{{ old('meta_title_en') }}">
                </div>
                <div class="col-md-6">
                    <label>Meta Title (ID)</label>
                    <input type="text" name="meta_title_id" class="form-control" placeholder="Meta Title Indonesian"
                        value="{{ old('meta_title_id') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Meta Keyword (EN)</label>
                    <input type="text" name="meta_keyword_en" class="form-control" placeholder="Meta Keyword English"
                        value="{{ old('meta_keyword_en') }}">
                </div>
                <div class="col-md-6">
                    <label>Meta Keyword (ID)</label>
                    <input type="text" name="meta_keyword_id" class="form-control" placeholder="Meta Keyword Indonesian"
                        value="{{ old('meta_keyword_id') }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label>Meta Description (EN)</label>
                    <textarea name="meta_description_en" class="form-control" rows="2" placeholder="Meta Description English">{{ old('meta_description_en') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>Meta Description (ID)</label>
                    <textarea name="meta_description_id" class="form-control" rows="2" placeholder="Meta Description Indonesian">{{ old('meta_description_id') }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </div>
        </form>
    </div>
@endsection
