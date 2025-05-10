{{-- 
@extends('admin.header')

@section('title')
    <div class="row">
        <div class="col-sm-12">
            
            <div class="card">
                <div class="card-header">
                    <h2>Add Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('addCategory') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product" class="form-label">Product Name</label>
                            <input type="text" name="product" id="product" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Product Category </label>
                            <select name="category" id="category" class="form-control">
                                <option value="0"> Main Category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product" class="form-label">Product Price</label>
                            <input type="text" name="product" id="product" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="product" class="form-label">Product Quantity</label>
                            <input type="text" name="product" id="product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="product" class="form-label">Product Photo</label>
                            <input type="file" name="product" id="product" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="product" class="form-label">Product Discription</label>
                            <textarea id="product" name="product" ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
@endsection
 

  --}}

  @extends('admin.header')

@section('title')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h2>Add Product</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" name="product_price" id="product_price" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="product_quantity" class="form-label">Product Quantity</label>
                            <input type="number" name="product_quantity" id="product_quantity" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    </div>

                   <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea id="product_description" name="product_description" class="form-control" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="product_photo" class="form-label">Product Photo</label>
                        <input type="file" name="product_photo" id="product_photo" class="form-control" @error('photo') is-invalid @enderror required onchange="previewImage(event)">
                        
                        <br>
                        <img id="photo_preview" src="#" alt="Image Preview" style="display:none; max-width: 200px; border: 1px solid #ccc; padding: 5px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS for Image Preview -->
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
