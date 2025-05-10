
@extends('admin.header')

@section('title')
    <div class="row">
        

        {{-- Table to Display Products --}}
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product List</h3>
                </div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count()) {{-- Check if categories exist --}}
                                @foreach ($products as $prod)
                                    <tr>
                                        <td>{{ $prod->id }}</td>
                                        <td>{{ $prod->name }}</td>
                                        <td>{{ optional($prod->category)->category ?? 'No Category' }}</td>
                                        <td>{{ $prod->price }}</td>
                                        <td>{{ $prod->quantity }}</td>
                                        <td>{{ $prod->description }}</td>
                                        <td>
                                            @if ($prod->photo)
                                            <img src="{{ asset($prod->photo) }}" alt="{{ $prod->name }}" width="100">

                                            @else
                                                No Image
                                                
                                            @endif                                            
                                        </td>
                                        {{-- <td style="display: flex">
                                            <button class="btn btn-sm btn-outline-info m-1" data-bs-toggle="modal" 
                                                data-bs-target="#editCategoryModal" data-id="{{ $cat->id }}" 
                                                data-category="{{ $cat->category }}" data-parent_id="{{ $cat->parent_id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger m-1">Delete</button>
                                            </form>
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('products.edit', $prod->id) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $prod->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No Product found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

