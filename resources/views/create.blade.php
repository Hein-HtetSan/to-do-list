@extends('master')

@section('content')

    <div class="container rounded">
        <div class="row mt-2">
            <div class="col-12 col-md-5 p-3 rounded">
                <div class="">
                    {{-- alert message  --}}
                    @if (session('insertsuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('insertsuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updatesuccess'))
                        <div class="alert-message">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{ session('updatesuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deletesuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deletesuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    {{-- model box  --}}


                    <form action="{{ route('post#create') }}" method="post" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="text-group">
                            <label for="postTitle" class="h5 text-dark">Title</label>
                            <input type="text" name="postTitle" id="postTitle" value="{{ old('postTitle') }}"
                                class="form-control @error('postTitle') is-invalid  @enderror"
                                placeholder="Enter Post Title">
                            @error('postTitle')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mt-3">
                            <label for="postDesc" class="h5 text-dark">Description</label>
                            <textarea name="postDesc" id="postDesc" cols="30" rows="5"
                                class="form-control  @error('postDesc') is-invalid  @enderror" placeholder="Enter Post Description">{{ old('postDesc') }}</textarea>
                            @error('postDesc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mt-3">
                            <label for="postImage" class="h5 text-dark">Image</label>
                            <input type="file" name="postImage" id="postImage" value="{{ old('postImage') }}"
                                class="form-control @error('postImage') is-invalid  @enderror"
                                placeholder="Enter Course Fee">
                            @error('postImage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mt-3">
                            <label for="postFee" class="h5 text-dark">Fee</label>
                            <input type="text" name="postFee" id="postFee" value="{{ old('postFee') }}"
                                class="form-control @error('postFee') is-invalid  @enderror" placeholder="Enter Post Fee">
                            @error('postFee')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mt-3">
                            <label for="postAddress" class="h5 text-dark">Address</label>
                            <input type="text" name="postAddress" id="postAddress" value="{{ old('postAddress') }}"
                                class="form-control @error('postAddress') is-invalid  @enderror"
                                placeholder="Enter Post Address">
                            @error('postAddress')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mt-3">
                            <label for="postRating" class="h5 text-dark">Rating</label>
                            <input type="number" min="0" max="5" name="postRating" id="postRating"
                                value="{{ old('postRating') }}"
                                class="form-control @error('postRating') is-invalid  @enderror"
                                placeholder="Enter Post Rating">
                            @error('postRating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" value="Create" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-7 p-3 ">

                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-5 col-md-7 text-secondary h3">Total: {{ $posts->total() }}</div>

                        {{-- Searching Data  --}}

                        <div class="col-7 col-md-5">
                            <form action="{{ route('post#createPage') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                        class="form-control" placeholder="Search" aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <button type="submit" class="input-group-text btn-primary btn" id="basic-addon2"><i
                                            class="fas fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="data-container">

                    @if (count($posts) != 0)
                        {{-- return all posts  --}}
                        @foreach ($posts as $item)
                            <div class="post p-3 shadow-sm rounded mb-2 border bg-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4>{{ $item['title'] }}</h4>
                                    <span
                                        class="">{{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}</span>
                                </div>
                                {{-- <p class="text-muted">{{ $item['desc'] }}</p> --}}
                                <p class="text-dark">{{ Str::words($item['desc'], 50, '...') }}</p>

                                <span>
                                    <small><i class="fas fa-dollar text-primary"></i> {{ $item['price'] }} Kyat</small>
                                </span>
                                |
                                <span>
                                    <small><i class="fas fa-map-pin text-danger"></i> {{ $item['address'] }} </small>
                                </span>
                                |
                                <span>
                                    <small><i class="fas fa-star text-warning"></i> {{ $item['rating'] }} </small>
                                </span>

                                <div class="text-end">
                                    <a href="{{ route('post#delete', $item['id']) }}">
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </a>
                                    {{-- <form action="{{ route('post#delete', $item['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form> --}}
                                    <a href="{{ route('post#update', $item['id']) }}">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-file-lines"></i>
                                            Read</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-warning">No Data!</h3>
                    @endif


                    {{ $posts->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
