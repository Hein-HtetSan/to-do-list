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
                <h3>{{ $data[0]['title'] }}</h3>
                <p class="text-muted">
                    {{ $data[0]['desc'] }}
                </p>
                <small>Price: {{ $data[0]['price'] }}</small> | <small>Address: {{ $data[0]['address'] }}</small> | <small>Rating: {{ $data[0]['rating'] }}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-4 offset-8 mt-2">
                <a href="{{ route('post#edit', $data[0]['id']) }}">
                    <Button class="bg-dark text-white btn rounded">Edit</Button>
                </a>
            </div>
        </div>
    </div>

@endsection