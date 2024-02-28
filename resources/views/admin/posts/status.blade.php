
@if(!$post->trashed())
<div class="modal fade" id="hidden-user{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="h4 text-danger modal-title"><i class="fa-solid fa-eye-slash"> Hide Post</i></h4>
            </div>
            <div class="modal-body">
                Are you sure you want to hide this post?
                <br><br>
                <img src="{{ $post->Image }}" alt="" class="image-lg">
                <div class="font-dark">{{ $post->description }}</div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hidden', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Hide</button>
                </form>

            </div>
        </div>
    </div>
</div>
@else
    <div class="modal fade" id="unhide-post{{ $post->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-primary">
                <div class="modal-header border-primary">
                    <h4 class="h4 text-primary modal-title"><i class="fa-solid fa-eye"> Unhide Post {{ $post->id }} </i></h4>
                </div>
                <div class="modal-body text-dark">
                    Are you sure you want to unhide this post?
                    <br><br>
                    <img src="{{ $post->Image }}" alt="" class="image-lg">
                    <div class="font-dark">{{ $post->description }}</div>
                </div>
                
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Unhide</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif