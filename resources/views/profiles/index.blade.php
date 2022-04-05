@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">

            <img src="/storage/{{ $user->profile->profileImage()  }}" class="rounded-circle w-100">
            
        </div>

        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="div d-flex align-items-center pb-3">
                    <div class="h3">{{ $user->username }}</div>
                    
                    {{-- Hide follow button for own profile --}}
                    @cannot('update', $user->profile)
                      <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}" ></follow-button>
                    @endcan

                </div>


                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            
            </div>

            @can('update', $user->profile)
            <a href="/profile/{{ $user->id }}/edit" class="">Edit Profile</a>
            @endcan

            <div class="d-flex">
                <div class="pe-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pe-5"><strong>{{ $followerCount }}</strong> followers</div>
                <div class="pe-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{ $user->profile->title ?? $user->name}}</strong></div>
            <div>{{ $user->profile->description ?? ''}}</div>
            <div><a href="#"><strong>{{ $user->profile->url ?? ""}}</strong></a></div>
        </div>
    </div>
    <div class="row pt-4">
        {{-- $user->posts = Count the amount of posts --}}
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
            {{-- Get the image from the path : storage/imagepath --}}
            <a href="/p/{{ $post->id }}"><img src="{{ URL::asset('storage/'. $post->image) }}" alt="" class="w-100"></a>
        </div>    
        @endforeach
        
</div>
@endsection
