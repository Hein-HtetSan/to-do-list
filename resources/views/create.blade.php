@extends('master')

@section('content')
    
    <div class="container rounded">
        <div class="row mt-5">
            <div class="col-12 col-md-5 p-3 rounded">
                <div class="">
                    {{-- alert message  --}}
                    @if (session("insertsuccess"))
                    <div class="alert-message">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session("insertsuccess") }}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>    
                    @endif
                    @if (session("updatesuccess"))
                    <div class="alert-message">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{ session("updatesuccess") }}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>    
                    @endif
                    @if (session("deletesuccess"))
                    <div class="alert-message">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session("deletesuccess") }}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <form action="{{ route('post#create') }}" method="post">
                    @csrf
                    <div class="text-group">
                        <label for="" class="h3 text-dark">Post Title</label>
                        <input type="text" name="postTitle" id="" value="{{ old("postTitle")}}" class="form-control @error('postTitle') is-invalid  @enderror" placeholder="Enter Post Title">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mt-3" >
                        <label for="" class="h3 text-dark">Post Description</label>
                        <textarea name="postDesc" id="" cols="30" rows="10" class="form-control  @error('postDesc') is-invalid  @enderror" placeholder="Enter Post Description">{{ old("postDesc" )}}</textarea>
                        @error('postDesc')
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
                <div class="data-container">

                    <h2 class="text-warning">Total: {{ $posts->total() }}</h2>

                    @foreach ($posts as $item)
                    <div class="post p-3 shadow-sm rounded mb-2 border">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4>{{ $item['title'] }}</h4>
                            <span class="">{{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}</span>
                        </div>
                        {{-- <p class="text-muted">{{ $item['desc'] }}</p> --}}
                        <p class="text-dark">{{ Str::words($item['desc'], 50, '...') }}</p>
                        <div class="text-end">
                            <a href="{{ route('post#delete', $item['id']) }}">
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </a>
                            {{-- <form action="{{ route('post#delete', $item['id']) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form> --}}
                            <a href="{{ route('post#update', $item['id']) }}">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-file-lines"></i></button>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection