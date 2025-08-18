@extends('layouts.master')

@section('title', 'Edit Category')

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
				<li class="breadcrumb-item active" aria-current="page">Edit Category</li>
			</ol>
		</nav>
		<!-- End Breadcrumb -->

		<div class="mb-3 mb-md-4">
			<div class="h3 mb-0">Edit Category</div>
		</div>

		<!-- Form -->
		<div>
			<form action="{{ route('category.update', $category) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="form-row">
					<div class="form-group col-12 col-md-6">
						<label for="name">Name</label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Category Name" required>
						@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="image">Image</label>
						@if($category->image)
							<div class="mb-2">
								<img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-height: 100px;">
								<small class="d-block text-muted">Current image</small>
							</div>
						@endif
						<input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
						@error('image')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
					</div>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Category Description">{{ old('description', $category->description) }}</textarea>
					@error('description')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
						<label class="custom-control-label" for="is_active">Active</label>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Update Category</button>
				<a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
		<!-- End Form -->
	</div>
</div>
@endsection
