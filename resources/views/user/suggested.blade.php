@extends('layouts.app')

@section('title', 'Suggested')

@section('content')

<div class="w-25 mx-auto">
    <form action="{{ route('home.suggested') }}" method="get" class="my-4">   
        <input type="text" name="search" id="search" placeholder="Search names..." class="form-control form-control-sm">
    </form>

    <h3 class="h4 mb-4">Suggested</h3>
    @foreach($suggested_users as $user)
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-md">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none fw-bold text-dark">{{ $user->name }}</a>
                <p class="text-muted mb-0">{{ $user->email }}</p>
                    @if($user->isFollower())
                        <p class="text-muted mb-0">Follows you</p>
                    @elseif($user->followers->count() >= 2)
                        <p class="text-muted mb-0">{{ $user->followers->count() }} followers</p>
                    @elseif($user->followers->count() == 1)
                        <p class="text-muted mb-0">1 follower</p>
                    @else
                        <p class="text-muted mb-0">no followers</p>
                    @endif
            </div>
            <div class="col-auto">
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn shadow-none p-0 text-primary">Follow</button>
                </form>
            </div>
        </div>
    @endforeach

</div>

@endsection