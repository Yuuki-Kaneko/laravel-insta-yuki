@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

    <form action="{{ route('admin.posts') }}" method="get" style="width: 10rem;" class="ms-auto my-3">
        <input type="text" name="search" id="search" value="{{ old('$request->search') }}" placeholder="Search..." class="form-control form-control-sm">
    </form>

    <table class="table table-hover align-middle text-secondary bg-white border">
        <thead class="table-primary text-uppercasse small text-secondary fw-bold">
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </thead>
        <tbody>
            @forelse($all_posts as $post)
            <tr>
                <td class="text-center">
                    @if($post->id)
                        <p>{{ $post->id }}</p>
                    @endif
                </td>
                <td>
                    <!-- {{-- avatar/icon --}} -->
                    @if($post->Image)
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->Image }}" alt="" class="avatar-md d-block mx-auto image-lg">
                        </a>
                    @else
                        <i class="fa-solid fa-circle-user icon-md text-secondary d-block text-center"></i>
                    @endif
                </td>
                <td>
                    @if($post->categoryPosts)
                        @forelse($post->categoryPosts as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
                            @empty 
                            <div class="badge bg-dark">Uncategorized</div>
                        @endforelse
                    @endif
                </td>
                <td><a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold text-dark">{{ $post->user->name }}</a></td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <!-- {{-- status --}} -->
                    @if(!$post->trashed())
                        <i class="fa-solid fa-circle text-primary"></i> Visible
                    @else
                        <i class="fa-solid fa-circle-minus "></i> Hidden
                    @endif
                </td>
                <td>
                    <!-- {{-- menu --}} -->
                    <div class="dropdown">
                        <button class="btn shadow-none btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        @if(!$post->trashed())
                        <!-- {{-- deactivate --}} -->
                        <div class="dropdown-menu">
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hidden-user{{ $post->id }}">
                                <i class="fa-solid fa-eye-slash"></i> Hidden 
                            </button>
                        </div>
                        @else
                            <div class="dropdown-menu">
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post{{ $post->id }}">
                                    <i class="fa-solid fa-eye text-primary"></i> Visible
                                </button>
                            </div>
                        @endif

                        @include('admin.posts.status')
                    </div>
                </td>
            </tr>

            @empty
                <tr>
                    <td class="text-center" colspan="6">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $all_posts->links() }}

@endsection