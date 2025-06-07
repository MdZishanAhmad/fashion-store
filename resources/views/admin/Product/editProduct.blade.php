@extends('admin.header')
@section('title', 'Show_products')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h2>Edit Product</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" value="{{ $product->name }}" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" name="product_price" id="product_price" value="{{ $product->price }}" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="product_quantity" class="form-label">Product Quantity</label>
                            <input type="text" name="product_quantity" id="product_quantity" value="{{ $product->quantity }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $cat->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea id="product_description" name="product_description" class="form-control" rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="product_photo" class="form-label">Product Photo</label>
                        <input type="file" name="product_photo" id="product_photo" class="form-control" onchange="previewImage(event)">
                        <br>
                        <img id="photo_preview" src="{{ asset($product->photo) }}" alt="Product Image" style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
                    </div>

                    <button type="submit" class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS to Preview Image -->
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo_preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
