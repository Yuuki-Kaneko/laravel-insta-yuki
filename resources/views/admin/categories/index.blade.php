@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')


<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-auto">
            <input type="text" name="category" id="category" value="{{ old('category') }}" class="form-control p-2" placeholder="Add a category...">
            @error('category')
                <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="col ps-0">
            <button type="submit" class="btn btn-primary p-2"><i class="fa-solid fa-plus"></i> Add </button>
        </div>
    </div>
</form>

<table class="table table-sm table-hover align-middle text-center text-secondary border mt-4">
    <thead class="table-warning text-secondary">
        <th>#</th>
        <th>NAME</th>
        <th>COUNT</th>
        <th>LAST UPDATED</th>
        <th></th>
    </thead>
    <tbody>
        @forelse($all_categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td class="text-dark">{{ $category->name }}</td>
            <td>{{ $category->categoryPosts->count() }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <button class="btn btn-none" data-bs-toggle="modal" data-bs-target="#update-category{{ $category->id }}"><i class="fa-solid fa-pen text-warning border border-warning rounded rounded-2 p-2"></i></button>
                <button class="btn btn-none" data-bs-toggle="modal" data-bs-target="#delete-category{{ $category->id }}"><i class="fa-solid fa-trash-can text-danger border border-danger rounded rounded-2 p-2"></i></button>
                
                @include('admin.categories.actions')
            </td>
        </tr>
        @empty
            <tr>
                <td class="text-center" colspan="6">No categories found.</td>
            </tr>
        @endforelse
        <tr>
            <td>0</td>
            <td>Uncategorized</td>
            <td>{{ $uncategorized_count }}</td>
        </tr>
    </tbody>

</table>


@endsection