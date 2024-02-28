@extends('layouts.app')

@section('title', 'Show Post')
<style>
    .col-4{
        overflow-y: scroll;
    }
    .card-body {
        position: absolute;
        top: 65px;
    }
</style>
@section('content')
    <div class="row border shadow">
        <div class="col border-end p-0">
            <img src="{{ $post->Image }}" alt="" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                @include('user.posts.contents.title')
                <div class="card-body w-100">
                    @include('user.posts.contents.body')
                        {{-- comments --}}
                    @include('user.posts.contents.comments.create')
                        {{-- list of comments --}}

                        @foreach($post->comments->take(3) as $comment)
                            @include('user.posts.contents.comments.list-item')
                        @endforeach
                        @if($post->comments->count() > 3)
                            <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none small mb-3">
                                View all {{ $post->comments->count() }} comments
                            </a>
                        @endif
                </div>  
            </div>
            
        </div>
    </div>

@endsection