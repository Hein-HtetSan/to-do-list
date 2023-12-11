@extends('master')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5 post">
                <div class="mb-3">
                    <a href="{{ route('post#update', $data[0]['id']) }}" class="text-decoration-none text-black">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>

                <form action="{{ route('post#updateNow') }}" method="post">
                    @csrf
                    <input type="hidden" name="postId" value={{ $data[0]['id'] }}>
                    <label for="postTitle" class="h3 text-secondary">Title</label>
                    <input type="text" id="postTitle" class="form-control my-3 @error('postTitle') is-invalid @enderror" name="postTitle" value="{{ $data[0]['title'] }}" placeholder="Enter Post Title" required>
                    @error('postTitle')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="postDesc" class="h3 text-secondary">Description</label>
                    <textarea name="postDesc" id="postDesc" cols="30" rows="5" class="form-control my-3 @error('postDesc') is-invalid @enderror" placeholder="Enter Post Description" required>{{ $data[0]['desc'] }}</textarea>
                    @error('postDesc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <label for="postFee" class="h3 text-secondary">Fee</label>
                    <input type="text" id="postFee" class="form-control my-3 @error('postFee') is-invalid @enderror" name="postFee" value="{{ $data[0]['price'] }}" placeholder="Enter Post Fee" required>
                    @error('postFee')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <label for="postAddress" class="h3 text-secondary">Address</label>
                    <input type="text" id="postAddress" class="form-control my-3 @error('postAddress') is-invalid @enderror" name="postAddress" value="{{ $data[0]['address'] }}" placeholder="Enter Post Fee" required>
                    @error('postAddress')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <label for="postRating" class="h3 text-secondary">Rating</label>
                    <input type="range" id="postRating" min="0" max="5" class="form-control my-3 @error('postRating') is-invalid @enderror" name="postRating" value="{{ $data[0]['rating'] }}" placeholder="Enter Post Fee" required>
                    @error('postRating')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="submit" value="Update" class="btn bg-dark text-white my-2">
                </form>

            </div>
        </div>
    </div>

@endsection