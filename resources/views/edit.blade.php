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
                    <label for="" class="h3 text-secondary">Post Title</label>
                    <input type="text" class="form-control my-3 @error('postTitle') is-invalid @enderror" name="postTitle" value="{{ $data[0]['title'] }}" placeholder="Enter Post Title" required>
                    @error('postTitle')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="" class="h3 text-secondary">Post Description</label>
                    <textarea name="postDesc" id="" cols="30" rows="10" class="form-control my-3 @error('postDesc') is-invalid @enderror" placeholder="Enter Post Description" required>{{ $data[0]['desc'] }}</textarea>
                    @error('postDesc')
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