
<div class="modal fade" id="liked-user{{ $post->id }}">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <button type="button" data-bs-dismiss="modal" class="btn btn-none text-end pt-3 pe-3"><i class="fa-solid fa-circle-xmark text-primary"></i></button>
            <div class="row justify-content-center pb-4">
                <div class="col-8">
                    <h3 class="h4 text-muted mb-2"></h3>

                    @foreach($post->likes as $like)
                        <div class="row mb-2 align-items-center">
                            <div class="col-auto">
                            <a href="{{ route('profile.show', $like->user->id) }}">
                                @if($like->user->avatar)
                                    <img src="{{ $like->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $like->user->id) }}" class="text-decoration-none text-dark fw-dark">{{ $like->user->name }}</a>
                            </div>
                            <div class="col-auto">
                                @if($like->user->id != Auth::user()->id)
                                    @if($like->user->isFollowed())
                                        {{-- unfollow --}}
                                            <form action="{{ route('follow.destroy', $like->user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0 shadow-none text-secondary">Unfollow</button>
                                            </form>
                                    @else
                                        {{-- follow --}}
                                        <form action="{{ route('follow.store', $like->user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn shadow-none text-primary">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>