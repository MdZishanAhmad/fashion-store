@extends('admin.header')
@section('title', 'Admin-Category')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Category Add Form --}}
            <div class="card">
                <div class="card-header">
                    <h2>Add Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('addCategory') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category Name</label>
                            <input type="text" name="category" id="category" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Category (Optional)</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0"> Main Category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Table to Display Categories --}}
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Categories List</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <!-- Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Category</th>
                                <th>Parent Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($category->count())
                                @foreach ($category as $cat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cat->category }}</td>
                                        <td>{{ $cat->parent ? $cat->parent->category : 'None' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info m-1 edit-category" 
                                                data-id="{{ $cat->id }}" 
                                                data-category="{{ $cat->category }}" 
                                                data-parent_id="{{ $cat->parent_id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('deleteCategory', $cat->id) }}" method="POST" 
                                                  style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger m-1" 
                                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No categories found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_category" class="form-label">Category Name</label>
                            <input type="text" name="category" id="edit_category" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_parent_id" class="form-label">Parent Category</label>
                            <select name="parent_id" id="edit_parent_id" class="form-control">
                                <option value="0">Main Category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button clicks
            document.querySelectorAll('.edit-category').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const category = this.getAttribute('data-category');
                    const parentId = this.getAttribute('data-parent_id') || 0;
                    
                    // Set form action
                    document.getElementById('editCategoryForm').action = `/category/${id}`;
                    
                    // Fill form fields
                    document.getElementById('edit_category').value = category;
                    document.getElementById('edit_parent_id').value = parentId;
                    
                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
                    modal.show();
                });
            });
        });
    </script>
@endsection