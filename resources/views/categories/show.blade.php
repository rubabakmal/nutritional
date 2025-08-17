@extends('layouts.master')

@section('title', 'Category Details')

@section('content')

@include('components.notification')

<div class="card mb-3 mb-md-4">

	<div class="card-body">
		<!-- Breadcrumb -->
		<nav class="d-none d-md-block" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('category.index') }}">Categories</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
			</ol>
		</nav>
		<!-- End Breadcrumb -->

		<div class="mb-3 mb-md-4 d-flex justify-content-between">
			<div class="h3 mb-0">Category Details</div>
			<div>
				<a href="{{ route('category.edit', $category) }}" class="btn btn-primary btn-sm">
					<i class="gd-pencil"></i> Edit
				</a>
				<a href="#" class="btn btn-danger btn-sm"
				   onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')">
					<i class="gd-trash"></i> Delete
				</a>
				<a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">
					Back to List
				</a>
			</div>
		</div>

		<!-- Category Details -->
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Information</h5>

						<dl class="row">
							<dt class="col-sm-3">Name:</dt>
							<dd class="col-sm-9">{{ $category->name }}</dd>

							<dt class="col-sm-3">Slug:</dt>
							<dd class="col-sm-9">{{ $category->slug }}</dd>

							<dt class="col-sm-3">Status:</dt>
							<dd class="col-sm-9">
								@if($category->is_active)
									<span class="badge badge-success">Active</span>
								@else
									<span class="badge badge-danger">Inactive</span>
								@endif
							</dd>

							<dt class="col-sm-3">Description:</dt>
							<dd class="col-sm-9">{{ $category->description ?: 'No description provided' }}</dd>

							<dt class="col-sm-3">Created:</dt>
							<dd class="col-sm-9">{{ $category->created_at->format('M d, Y h:i A') }}</dd>

							<dt class="col-sm-3">Last Updated:</dt>
							<dd class="col-sm-9">{{ $category->updated_at->format('M d, Y h:i A') }}</dd>
						</dl>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
					<div class="card-body text-center">
						<h5 class="card-title">Category Image</h5>
						@if($category->image)
							<img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid rounded">
						@else
							<div class="py-5">
								<i class="gd-image icon-text icon-text-xxl text-muted"></i>
								<p class="text-muted">No image uploaded</p>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<!-- End Category Details -->

		<form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy', $category) }}" method="POST" style="display: none;">
			@csrf
			@method('DELETE')
		</form>

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
