@extends('layouts.master')

@section('title', 'Product Details')

@section('content')

@include('components.notification')

<div class="card mb-3 mb-md-4">

	<div class="card-body">
		<!-- Breadcrumb -->
		<nav class="d-none d-md-block" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('product.index') }}">Products</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
			</ol>
		</nav>
		<!-- End Breadcrumb -->

		<div class="mb-3 mb-md-4 d-flex justify-content-between">
			<div class="h3 mb-0">Product Details</div>
			<div>
				<a href="{{ route('product.edit', $product) }}" class="btn btn-primary btn-sm">
					<i class="gd-pencil mr-1"></i> Edit
				</a>
				<a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
					<i class="gd-arrow-left mr-1"></i> Back
				</a>
			</div>
		</div>

		<!-- Product Details -->
		<div class="row">
			<div class="col-md-6">
				<div class="mb-4">
					<h5>Product Information</h5>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th width="30%">Name</th>
								<td>{{ $product->name }}</td>
							</tr>
							<tr>
								<th>SKU</th>
								<td>{{ $product->sku }}</td>
							</tr>
							<tr>
								<th>Category</th>
								<td>{{ $product->category->name }}</td>
							</tr>
							<tr>
								<th>Price</th>
								<td>{{ $product->formatted_price }}</td>
							</tr>
							<tr>
								<th>Quantity</th>
								<td>{{ $product->quantity }}</td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<span class="badge badge-{{ $product->status_badge }}">{{ ucfirst($product->status) }}</span>
								</td>
							</tr>
							<tr>
								<th>Featured</th>
								<td>
									@if($product->is_featured)
										<span class="badge badge-info">Yes</span>
									@else
										<span class="badge badge-light">No</span>
									@endif
								</td>
							</tr>
							<tr>
								<th>Created</th>
								<td>{{ $product->created_at->format('M d, Y h:i A') }}</td>
							</tr>
							<tr>
								<th>Last Updated</th>
								<td>{{ $product->updated_at->format('M d, Y h:i A') }}</td>
							</tr>
						</table>
					</div>
				</div>

				@if($product->description)
				<div class="mb-4">
					<h5>Description</h5>
					<p>{{ $product->description }}</p>
				</div>
				@endif
			</div>

			<div class="col-md-6">
				<div class="mb-4">
					<h5>Featured Image</h5>
					@if($product->image)
						<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
					@else
						<div class="alert alert-secondary">
							No featured image uploaded
						</div>
					@endif
				</div>

				@if($product->gallery && count($product->gallery) > 0)
				<div class="mb-4">
					<h5>Gallery Images</h5>
					<div class="row">
						@foreach($product->gallery as $galleryImage)
						<div class="col-4 mb-3">
							<img src="{{ asset('storage/' . $galleryImage) }}" alt="Gallery" class="img-fluid rounded">
						</div>
						@endforeach
					</div>
				</div>
				@endif
			</div>
		</div>
		<!-- End Product Details -->

		<div class="mt-4">
			<a href="{{ route('product.index') }}" class="btn btn-secondary">
				<i class="gd-arrow-left mr-1"></i> Back to Products
			</a>
		</div>
	</div>
</div>

@endsection
