@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="/storage/{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width: 50px">
                    </div>
                    <strong><a style="text-decoration: none" href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></strong>
                    @cannot('update', $post->user->profile)
                    <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>
                  @endcan
                </div>
                <hr>

                <p>
                    <span><strong><a style="text-decoration: none" href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}
                    </span></strong></a>
                {{ $post->caption }}</p>
            </div>
        </div>
    </div>

</div>
@endsection
