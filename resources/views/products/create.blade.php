@extends('layouts.master')

@section('title', 'Add Product')

@section('content')

    @include('components.notification')

    <div class="card mb-3 mb-md-4">

        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item ">
                        <a href="{{ route('product.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4">
                <div class="h3 mb-0">Add Product</div>
            </div>

            <!-- Form -->
            <div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Product Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="price">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                    value="{{ old('price') }}" placeholder="0.00" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" value="{{ old('quantity', 0) }}" placeholder="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" placeholder="Product Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="image">Featured Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Main product image. Supported formats: JPEG, PNG, JPG, GIF
                                (Max: 2MB)</small>

                            <!-- Featured Image Preview -->
                            <div id="featuredImagePreview" class="mt-3" style="display: none;">
                                <div class="position-relative d-inline-block">
                                    <img id="featuredImagePreviewImg" src="" alt="Preview" class="img-thumbnail"
                                        style="max-width: 200px; max-height: 200px;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute"
                                        style="top: 5px; right: 5px;" onclick="removeFeaturedImage()">
                                        <i class="gd-close"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="gallery">Gallery Images</label>
                            <input type="file" class="form-control-file @error('gallery.*') is-invalid @enderror"
                                id="gallery" accept="image/*" multiple>
                            @error('gallery.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Additional product images. You can select multiple files or
                                add one by one.</small>

                            <!-- Gallery Images Preview -->
                            <div id="galleryPreview" class="mt-3 d-flex flex-wrap"></div>

                            <!-- Hidden container for gallery files -->
                            <div id="galleryFilesContainer"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status">
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out
                                    of Stock</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <div class="custom-control custom-checkbox mt-4">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">Featured Product</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary shop-now-btn">Create Product</button>
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- End Form -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Featured image preview
        const featuredImageInput = document.getElementById('image');
        const featuredImagePreview = document.getElementById('featuredImagePreview');
        const featuredImagePreviewImg = document.getElementById('featuredImagePreviewImg');

        featuredImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: `The file "${file.name}" is ${fileSizeMB}MB. Maximum allowed size is 2MB.`,
                        confirmButtonColor: '#dc3545'
                    });
                    // Clear the input
                    featuredImageInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    featuredImagePreviewImg.src = e.target.result;
                    featuredImagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        function removeFeaturedImage() {
            featuredImageInput.value = '';
            featuredImagePreview.style.display = 'none';
            featuredImagePreviewImg.src = '';
        }

        // Gallery images management
        let galleryFiles = [];
        const galleryInput = document.getElementById('gallery');
        const galleryPreview = document.getElementById('galleryPreview');
        const galleryFilesContainer = document.getElementById('galleryFilesContainer');

        galleryInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    addGalleryImage(file);
                }
            });
            // Clear the input so user can add more files
            e.target.value = '';
        });

        function addGalleryImage(file) {
            const id = Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            galleryFiles.push({
                id,
                file
            });

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewHtml = `
			<div class="position-relative mr-2 mb-2" id="gallery_${id}">
				<img src="${e.target.result}" alt="Gallery" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
				<button type="button" class="btn btn-danger btn-sm position-absolute" style="top: -5px; right: -5px; padding: 2px 6px;" onclick="removeGalleryImage('${id}')">
					<i class="gd-close"></i>
				</button>
			</div>
		`;
                galleryPreview.insertAdjacentHTML('beforeend', previewHtml);
            }
            reader.readAsDataURL(file);

            updateGalleryInput();
        }

        function removeGalleryImage(id) {
            galleryFiles = galleryFiles.filter(item => item.id !== id);
            document.getElementById(`gallery_${id}`).remove();
            updateGalleryInput();
        }

        function updateGalleryInput() {
            // Create a new file input for each gallery file
            galleryFilesContainer.innerHTML = '';
            galleryFiles.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'gallery[]';
                input.style.display = 'none';
                input.files = createFileList([item.file]);
                galleryFilesContainer.appendChild(input);
            });
        }

        // Helper function to create FileList from array
        function createFileList(files) {
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            return dataTransfer.files;
        }
    </script>
@endsection
