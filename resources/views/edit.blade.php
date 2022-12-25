@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3 bg-light shadow-sm">
                <div class="my-3">
                    <a href="{{ route('post#updatePage', $post['id']) }}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-caret-left"></i> Back</a>
                </div>
                {{-- <h3>{{ $post['title'] }}</h3>

                <p class="text-muted">{{ $post['description'] }}</p> --}}
                <form action="{{ route('post#update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="hidden" name="postId" class="form-control mt-2" value="{{ $post['id'] }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Post Title</label>
                        <input type="text" name="postTitle"
                            class="form-control mt-2
                                @error('postTitle')
                                is-invalid
                                @enderror"
                            value="{{ old('postTitle', $post['title']) }}" placeholder="Enter Post Title.....">

                        @error('postTitle')
                            <div class="invalid-feedback">

                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <div class=" mt-2">
                            @if ($post['image'] == null)
                                <img src="{{ asset('404_image.png') }}" class="img-thumbnail w-100 shadow-sm">
                            @else
                                <img src="{{ asset('storage/' . $post['image']) }}" class="img-thumbnail w-100 shadow-sm">
                            @endif
                        </div>
                        <input type="file" name="postImage"
                            class="form-control mt-2
                                @error('postImage')
                                is-invalid
                                @enderror">
                        @error('postImage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Post Description</label>
                        <textarea name="postDescription"
                            class="form-control mt-2
                                @error('postDescription')
                                is-invalid
                                @enderror"
                            cols="30" rows="10" placeholder="Enter Post Description.....">{{ old('postDescription', $post['description']) }}</textarea>

                        @error('postDescription')
                            <div class="invalid-feedback">

                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Price</label>
                        <input type="text" name="postPrice" class="form-control mt-2"
                            value="{{ old('postPrice', $post['price']) }}" placeholder="Enter Post Price.....">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Address</label>
                        <input type="text" name="postAddress" class="form-control mt-2"
                            value="{{ old('postAddress', $post['address']) }}" placeholder="Enter Post Address.....">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Rating</label>
                        <input type="number" name="postRating" class="form-control mt-2"
                            value="{{ old('postRating', $post['rating']) }}" placeholder="Enter Post Rating.....">
                    </div>

                    <div class="">
                        <button type="submit" class="btn bg-dark text-white float-end m-3">UPDATE</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
