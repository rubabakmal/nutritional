@extends('layouts.master')

@section('title', 'Products')

@section('content')

    @include('components.notification')

    <div class="card mb-3 mb-md-4">

        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Products</div>
                <a href="{{ route('product.create') }}" class="btn btn-primary shop-now-btn">
                    Add new
                </a>
            </div>

            <!-- Products -->
            <div class="table-responsive-xl">
                <table class="table text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Image</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Category</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Price</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Quantity</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Featured</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="py-3">{{ $product->id }}</td>
                                <td class="py-3">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="align-middle py-3">
                                    <div class="d-flex align-items-center">
                                        {{ $product->name }}
                                    </div>
                                </td>
                                <td class="py-3">{{ $product->category->name }}</td>
                                <td class="py-3">{{ $product->formatted_price }}</td>
                                <td class="py-3">{{ $product->quantity }}</td>
                                <td class="py-3">
                                    <span
                                        class="badge badge-{{ $product->status_badge }}">{{ ucfirst($product->status) }}</span>
                                </td>
                                <td class="py-3">
                                    @if ($product->is_featured)
                                        <span class="badge badge-info">Featured</span>
                                    @else
                                        <span class="badge badge-light">No</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        <a class="link-dark d-inline-block" href="{{ route('product.show', $product) }}"
                                            title="View">
                                            <i class="gd-eye icon-text"></i>
                                        </a>
                                        <a class="link-dark d-inline-block" href="{{ route('product.edit', $product) }}"
                                            title="Edit">
                                            <i class="gd-pencil icon-text"></i>
                                        </a>
                                        <a class="link-dark d-inline-block" href="#"
                                            onclick="deleteProduct({{ $product->id }}, '{{ $product->name }}')"
                                            title="Delete">
                                            <i class="gd-trash icon-text"></i>
                                        </a>
                                        <form id="delete-form-{{ $product->id }}"
                                            action="{{ route('product.destroy', $product) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-3">
                                    <strong>No products found</strong><br>
                                    <a href="{{ route('product.create') }}">Create your first product</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $products->links('components.pagination') }}

            </div>
            <!-- End Products -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function deleteProduct(productId, productName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to delete the product "${productName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('delete-form-' + productId).submit();
                }
            });
        }
    </script>
@endsection
