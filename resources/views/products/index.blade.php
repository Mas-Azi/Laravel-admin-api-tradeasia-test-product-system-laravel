@extends('layouts.app')

{{-- @section('title', 'Home Product') --}}

@section('contents')
    <div class="">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="mb-0">List Product</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        <!-- Success Message -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="productsTable" class="table table-striped table-bordered nowrap w-100">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Name (EN)</th>
                        <th>Name (ID)</th>
                        <th>HS Code</th>
                        <th>CAS Number</th>
                        <th>Image</th>
                        <th style="min-width:200px;">Description (EN)</th>
                        <th style="min-width:200px;">Description (ID)</th>
                        <th style="min-width:200px;">Application (EN)</th>
                        <th style="min-width:200px;">Application (ID)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <!-- Name -->
                            <td>{{ $item->name['en'] ?? '-' }}</td>
                            <td>{{ $item->name['id'] ?? '-' }}</td>

                            <!-- HS Code & CAS Number -->
                            <td>{{ $item->hs_code }}</td>
                            <td>{{ $item->cas_number ?? '-' }}</td>

                            <!-- Image -->
                            <td class="text-center">
                                @if ($item->image)
                                    <img src="{{ asset('storage/products/' . $item->image) }}" alt="Product Image"
                                        width="60" class="img-thumbnail">
                                @else
                                    -
                                @endif
                            </td>

                            <!-- Description -->
                            <td class="text-truncate" style="max-width: 200px;">
                                {{ $item->description['en'] ?? '-' }}
                            </td>
                            <td class="text-truncate" style="max-width: 200px;">
                                {{ $item->description['id'] ?? '-' }}
                            </td>

                            <!-- Application -->
                            <td class="text-truncate" style="max-width: 200px;">
                                {{ $item->application['en'] ?? '-' }}
                            </td>
                            <td class="text-truncate" style="max-width: 200px;">
                                {{ $item->application['id'] ?? '-' }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.show', $item->id) }}"
                                        class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="{{ route('products.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this product?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <!-- DataTables Bootstrap 5 + Responsive CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables core + Bootstrap 5 + Responsive -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('#productsTable').DataTable({
            //     pageLength: 10,
            //     lengthMenu: [5, 10, 25, 50],
            //     ordering: true,
            //     autoWidth: false,
            //     responsive: true,

            //     dom: '<"row mb-3"' +
            //         '<"col-md-6 d-flex align-items-center"l>' + // dropdown "show entries"
            //         '<"col-md-6 d-flex justify-content-end"f>' + // search box
            //         '>' +
            //         'rt' +
            //         '<"row mt-3"' +
            //         '<"col-md-6"i>' + // info ("showing x of y")
            //         '<"col-md-6 d-flex justify-content-end"p>' + // pagination
            //         '>',
            // });
            console.log('Init DataTables'); // untuk cek script jalan
            $('#productsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                responsive: true,
            });

        });
    </script>
@endpush
