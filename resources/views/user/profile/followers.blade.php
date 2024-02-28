@extends('layouts.app')

@section('title', 'Following')

@section('content')
    @include('user.profile.header')

    @if($user->follows->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="h4 text-muted mb-2">Followers</h3>

                @foreach($user->follower as $follower)
                    <div class="row mb-2 align-items-center">
                        <div class="col-auto">
                        <a href="{{ route('profile.show', $follower->follower->id) }}">
                            @if($follower->follower->avatar)
                                <img src="{{ $follow->follower->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show', $follow->follower->id) }}" class="text-decoration-none text-dark fw-dark">{{ $follow->followed->name }}</a>
                        </div>
                        <div class="col-auto">
                            @if($follow->follower->id != Auth::user()->id)
                                @if($follow->follower->isFollowed())
                                    {{-- unfollow --}}
                                        <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 shadow-none text-secondary">Following</button>
                                        </form>
                                @else
                                    {{-- follow --}}
                                    <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary"></button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-muted text-center h5">Not follower anyone yet.</p>
    @endif

@endsection