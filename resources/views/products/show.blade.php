@extends('layouts.master')

@section('content')
<div>

    <!-- Admin Controls -->
    <form class="form-inline mb-2" method="POST" action="{{ route('product.archive') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="slug" value="{{ $product->slug }}">
        <input type="submit" class="btn btn-sm btn-outline-dark px-4 mr-2" value="Archive">
        <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-sm btn-outline-dark px-4">
            Edit Product
        </a>
    </form>

    <div class="row">
        <div class="col-md-6">
        <img
            class="img-fluid"
            alt="Card image cap"
            style="object-fit: contain"
            src="/storage/products/{{$product->image}}">
        </div>
        <div class="col-md-6 mt-md-0 mt-4">
            <p class="h1 font-weight-bold text-capitalize">{{ $product->title }}</p>
            <p>{{ $product->short }}</p>
            <p class="h5 pb-2">&#x20B9; {{ $product->price }}</p>
            <small class="label">Products Description</small>
            <p>{!! $product->detail !!}</p>
        </div>
    </div>
</div>
@endsection

<style>
    .label {
        letter-spacing: 1.5px;
        font-weight: 500;
        text-decoration: underline;
    }
</style>
