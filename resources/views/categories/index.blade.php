@extends('layouts.master')

@section('title', 'Categories')

@section('content')

    @include('components.notification')

    <div class="card mb-3 mb-md-4">

        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Categories</div>
                <a href="{{ route('category.create') }}" class="btn btn-primary shop-now-btn">
                    Add new
                </a>
            </div>

            <!-- Categories -->
            <div class="table-responsive-xl">
                <table class="table text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Image</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Slug</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Created Date</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="py-3">{{ $category->id }}</td>
                                <td class="py-3">
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="align-middle py-3">
                                    <div class="d-flex align-items-center">
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td class="py-3">{{ $category->slug }}</td>
                                <td class="py-3">
                                    @if ($category->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-3">{{ $category->created_at->format('M d, Y') }}</td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        <a class="link-dark d-inline-block" href="{{ route('category.show', $category) }}"
                                            title="View">
                                            <i class="gd-eye icon-text"></i>
                                        </a>
                                        <a class="link-dark d-inline-block" href="{{ route('category.edit', $category) }}"
                                            title="Edit">
                                            <i class="gd-pencil icon-text"></i>
                                        </a>
                                        <a class="link-dark d-inline-block" href="#"
                                            onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')"
                                            title="Delete">
                                            <i class="gd-trash icon-text"></i>
                                        </a>
                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('category.destroy', $category) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3">
                                    <strong>No categories found</strong><br>
                                    <a href="{{ route('category.create') }}">Create your first category</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $categories->links('components.pagination') }}

            </div>
            <!-- End Categories -->
        </div>
    </div>

@endsection

@section('scripts')


    <script>
        function deleteCategory(categoryId, categoryName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to delete the category "${categoryName}"?`,
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
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }
    </script>
@endsection
