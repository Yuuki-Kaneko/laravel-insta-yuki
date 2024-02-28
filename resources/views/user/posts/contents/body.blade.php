<div class="row align-items-center">
    <div class="col-auto">
        <!-- {{-- heart button --}} -->
        @if($post->isLiked())
            <!-- {{-- unlike --}} -->
            <form action="{{ route('like.destroy', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn shodow-none p-0">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>
        @else
        <form action="{{ route('like.store', $post->id) }}" method="post">
            @csrf
                <button type="submit" class="btn shadow-none p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        @endif
    </div>
    <div class="col-auto px-0">
        <!-- {{-- no. of likes --}} -->
        @if($post->isLiked())
            <button class="btn btn-none p-0" data-bs-toggle="modal" data-bs-target="#liked-user{{ $post->id }}">{{ $post->likes->count() }}</button>
            
        @else
            {{ $post->likes->count() }}
        @endif

        @include('user.posts.contents.modals.likes')
        

    </div>
    <div class="col text-end">
        <!-- {{-- categories --}} -->
        @forelse($post->categoryPosts as $category_post)
            <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
        @empty 
            <div class="badge bg-dark">Uncategorized</div>
        @endforelse
    </div>
</div>

{{-- owner & description --}}
<a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
&nbsp;
<span class="fw-light">{{ $post->description }}</span>
<p class="text-muted text-uppercase xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>