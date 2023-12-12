@extends('master')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5 post">
                <div class="mb-3">
                    <a href="{{ route('post#home') }}" class="text-decoration-none text-black">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3>{{ $data->title }}</h3>
                    <div class="d-flex flex-column align-items-end">
                        <small><i class="fas fa-clock text-primary"></i> {{ $data->updated_at->format('d/m/Y') }}</small>
                        <small class="fw-bold"><i class="fas fa-time text-primary"></i> {{ $data->created_at->format('h') }}hr ago</small>
                    </div>
                </div>
                <div class="">
                    <div class="btn btn-sm btn-dark text-white me-2 my-2"><i class="fas fa-dollar text-primary"></i> {{ $data->price }}</div>
                    <div class="btn btn-sm btn-dark text-white me-2 my-2"><i class="fas fa-map-pin text-danger"></i> {{ $data->address }}</div>
                    <div class="btn btn-sm btn-dark text-white me-2 my-2"><i class="fas fa-star text-warning"></i> {{ $data->rating }}</div>
                </div>
                <div class="">
                    @if ($data->image == null)
                        <img src="{{ asset('image/Image_not_available.png') }}" alt="" class="img-thumbnail my-4 shadow-sm">
                    @else
                        <img src="{{ asset('storage/'.$data->image) }}" alt="" class="img-thumbnail my-4 shadow-sm">
                    @endif
                </div>
                <p class="text-muted">
                    {{ $data->desc }}
                </p>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-4 offset-8 mt-2">
                <a href="{{ route('post#edit', $data->id) }}">
                    <Button class="bg-dark text-white btn rounded">Edit</Button>
                </a>
            </div>
        </div>
    </div>

@endsection