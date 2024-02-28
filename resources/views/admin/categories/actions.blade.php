
<!-- delete category -->
<div class="modal fade" id="delete-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="h4 text-danger modal-title"><i class="fa-solid fa-trash-can"> Delete Category</i></h4>
            </div>
            <div class="modal-body text-start">
                Are you sure you want to delete <strong>{{ $category->name }}</strong> category?
                <br><br>
                <p>This action will affect all the posts under this category. Posts without a category will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- update category -->
<div class="modal fade" id="update-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h4 class="h4 text-admin.categories. modal-title text-dark"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h4>
            </div>
            
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="text" name="category" id="category" value="{{ $category->name }}" class="form-control text-start">
                </div>

                <div class="modal-footer border">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
