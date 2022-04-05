@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="mb-5">
                {{-- Image --}}
                <div class="">
                    <div class="row">
                        {{-- first part border --}}
                        <div class="pt-4 ps-4 pe-4 col-5 offset-3 border border-5 border-bottom-0 rounded">
                            
                            <a href="/p/{{ $post->id }}">
                                <img src="/storage/{{ $post->image }}" class="border border-5  w-100 rounded mx-auto d-block"></a>
                        </div>
                    </div>
                    {{-- Username + Caption --}}
                    <div class="row pb-4">
                        {{-- second part border --}}
                        <div class="col-5 offset-3 border border-5 border-top-0 rounded">
                            
                            <div>
                                <p>
                                <div class="ps-2 pt-2 pb-5">
                                    <strong><a style="text-decoration: none" href="/profile/{{ $post->user->id }}">
                                            <span class="text-dark">{{ $post->user->username }}
                                            </span></strong></a>
                                    {{ $post->caption }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
