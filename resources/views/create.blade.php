@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-5">
                <div class="p-3">
                    @if (session('insertSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('insertSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <form class="form" action="{{ route('post#create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="postTitle"
                                class="form-control mt-2
                                @error('postTitle')
                                is-invalid
                                @enderror"
                                value="{{ old('postTitle') }}" placeholder="Enter Post Title.....">

                            @error('postTitle')
                                <div class="invalid-feedback">
                                    {{-- Post Title ဖြည့်ရန်လိုအပ်ပါသည်! --}}
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
                                cols="30" rows="10" placeholder="Enter Post Description.....">{{ old('postDescription') }}</textarea>

                            @error('postDescription')
                                <div class="invalid-feedback">
                                    {{-- Post Description ဖြည့်ရန်လိုအပ်ပါသည်! --}}
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Image</label>
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
                            <label for="">Price</label>
                            <input type="number" name="postPrice" class="form-control mt-2" value="{{ old('postPrice') }}"
                                placeholder="Enter Price.....">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Address</label>
                            <input type="text" name="postAddress" class="form-control mt-2"
                                value="{{ old('postAddress') }}" placeholder="Enter Address.....">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Rating</label>
                            <input type="number" name="postRating" class="form-control mt-2"
                                value="{{ old('postRating') }}" min="0" max="5"
                                placeholder="Enter Post Rating">
                        </div>
                        <div class="mb-4">
                            <input type="submit" class="btn btn-secondary text-uppercase float-end mt-3 me-5"
                                value="Create">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-7">
                <h3 class="mb-3">
                    <div class="row">
                        <div class="col-4">Total - {{ $posts->total() }}</div>
                        <div class="col-6 offset-2">
                            <form action="{{ route('post#createPage') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control"
                                        value="{{ request('searchKey') }}" placeholder="Enter Search Key..."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="submit"><i
                                                class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </h3>
                <div class="data-container">
                    @if (count($posts) !== 0)
                        @foreach ($posts as $post)
                            <div class="post p-3 bg-light shadow-sm mb-4">
                                <div class="row">
                                    <h5 class="col-7 ">{{ $post['title'] }}</h5>
                                    <div class="col-4 offset-1">
                                        {{ $post['created_at']->format('j-F-Y | n:i A') }}</div>
                                </div>
                                <p class="text-muted">{{ Str::words($post['description'], 20, '.....') }}</p>

                                <span>
                                    <small><i class="fa-solid fa-money-bill-1 text-secondary"></i> {{ $post['price'] }}
                                        Kyats</small>
                                </span> |
                                <span>
                                    <i class="fa-solid fa-location-dot text-primary"></i> {{ $post['address'] }}
                                </span> |
                                <span>
                                    {{ $post['rating'] }} <i class="fa-solid fa-star text-warning"></i>
                                </span>

                                <div class="text-end">
                                    <a href="{{ route('post#delete', $post['id']) }}">
                                        <button class="btn btn-sm bg-secondary bg-opacity-25 text-danger"><i
                                                class="fa-solid fa-trash me-1"></i>ဖျက်ရန်</button>
                                    </a>

                                    {{-- For Route::delete --}}
                                    {{-- <form action="{{ route('post#delete', $post['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm bg-secondary bg-opacity-25 text-danger"><i
                                            class="fa-solid fa-trash me-1"></i>ဖျက်ရန်</button>
                                </form> --}}
                                    <a href="{{ route('post#updatePage', $post['id']) }}">
                                        <button class="btn btn-sm bg-secondary bg-opacity-25 text-primary"><i
                                                class="fa-solid fa-circle-info me-1"></i>အပြည့်အစုံဖတ်ရန်</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-danger text-center mt-5">There is no data.....</h3>
                    @endif

                </div>
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
