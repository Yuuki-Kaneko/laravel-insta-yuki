
<div class="modal fade" id="comments-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-secondary">
            <div class="modal-header border-secondary">
                <h4 class="h4 text-secondary modal-title">Recent Comments</h4>
            </div>
            <div class="modal-body text-secondary" style="height: 25rem; overflow: scroll;">  
                @forelse($user->comments->take(5) as $comment) 
                    <div class="border border-primary border-2 rounded p-3 my-2">
                        <p>{{ $comment->body }}</p>
                        <hr>
                        <p class="m-0">Replied to <a href="" class="text-decoration-none">{{ $comment->post->user->name }}'s post</a></p>
                    </div>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No comments found.</td>
                    </tr>
                @endforelse
            </div>

            <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
