@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3 shadow-sm">
                <div class="my-4">
                    <a href="{{ route('post#home') }}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-caret-left"></i> Back</a>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h3 class="text-center">{{ $post->title }}</h3>
                    </div>

                </div>
                <div class="d-flex">
                    <div class="mx-auto">
                        <i class="fa-regular fa-calendar-check"></i>{{ $post->updated_at->format('j-m-Y') }}
                    </div>
                    <div class="mx-auto">
                        <i class="fa-solid fa-clock"></i>{{ $post->updated_at->format('h:m:sA') }}
                    </div>
                </div>
                <div class="">
                    @if ($post->image == null)
                        <img src="{{ asset('404_image.png') }}" class="img-thumbnail w-100 my-4 shadow-sm">
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail w-100 my-4 shadow-sm">
                    @endif


                </div>

                <p class="text-muted">{{ $post->description }}</p>
                <div class="d-flex mb-5">
                    <div class="mx-auto">
                        <span>
                            <small><i class="fa-solid fa-money-bill-1 text-secondary"></i> {{ $post->price }}
                                Kyats</small>
                        </span>
                    </div>
                    <div class="mx-auto">
                        <span>
                            <i class="fa-solid fa-location-dot text-primary"></i> {{ $post->address }}
                        </span>
                    </div>
                    <div class="mx-auto">
                        <span>
                            {{ $post->rating }} <i class="fa-solid fa-star text-warning"></i>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row my-3">
            <div class="col-3 offset-8">
                <a href="{{ route('post#editPage', $post['id']) }}">
                    <button class="btn bg-dark text-white">EDIT</button>
                </a>
            </div>
        </div>
    </div>
@endsection
