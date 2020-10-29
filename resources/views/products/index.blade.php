@extends('layouts.master')

@section('content')
<div class="container-fluid mt-3">

    <div class="parent">
        @foreach ($products as $product)
        <div class="card child">
            <img
                class="card-img-top"
                alt="product image"
                src="/storage/products/{{$product->image}}">
            <div class="card-body p-2 ">
                <a
                    href="{{ route('products.show', $product->slug) }}"
                    class="{{ ($product->trashed() || $product->archive) ? '' : 'stretched-link' }}">
                    {{ $product->title }}
                </a>
                <p class="mb-0">&#x20B9; {{ $product->price }} per {{ $product->unit }}</p>
                @if ($product->archive)
                    <form class="form-inline mb-0" method="POST" action="{{ route('product.archive') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                        <input type="submit" class="btn btn-sm btn-outline-secondary btn-block mt-2" value="Unarchive">
                    </form>
                @endif
                @if ($product->trashed())
                    <form class="form-inline mb-0" method="POST" action="{{ route('product.restore') }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                        <input type="submit" class="btn btn-sm btn-outline-success btn-block mt-2" value="Restore">
                    </form>
                    <form class="form-inline mb-0" method="POST" action="{{ route('product.delete') }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                        <input type="submit" class="btn btn-sm btn-outline-danger btn-block mt-2" value="Destory">
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

<style scoped>
    .parent {
        display: flex;
        flex-flow: row wrap;
        margin:0 0 0 -.5rem;
    }

    .child {
        flex: 1 0 20%;/* less than 25% but more or equal to 20% to account for margins - when 4 across is required */
        min-width: 200px !important;/* min-width on flex items not working in older ios so use media queries instead*/
        margin:0 0 .5rem .5rem;
    }

    @media(min-width: 576px) {
        .child {
            max-width: 40vw;
        }
    }

    .card-img-top {
        object-fit: cover;
        object-position: top;
        min-height: 160px;
        max-height: 40vh;
    }

    .stretched-link {
        color: rgb(60, 60, 60);
        font-weight: 500;
        font-size: 1.2rem;
        text-transform: capitalize;
    }

    .stretched-link:hover {
        color: rgb(60, 60, 60);
        text-decoration: none;

    }

</style>
