@extends('layouts.master')

@section('title', 'Add Category')

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
				<li class="breadcrumb-item active" aria-current="page">Add Category</li>
			</ol>
		</nav>
		<!-- End Breadcrumb -->

		<div class="mb-3 mb-md-4">
			<div class="h3 mb-0">Add Category</div>
		</div>

		<!-- Form -->
		<div>
			<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div class="form-row">
					<div class="form-group col-12 col-md-6">
						<label for="name">Name</label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Category Name" required>
						@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="image">Image</label>
						<input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
						@error('image')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
					</div>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Category Description">{{ old('description') }}</textarea>
					@error('description')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
						<label class="custom-control-label" for="is_active">Active</label>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Create Category</button>
				<a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
		<!-- End Form -->
	</div>
</div>
@endsection
