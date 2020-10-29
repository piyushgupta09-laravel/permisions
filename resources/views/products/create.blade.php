@extends('layouts.master')

@section('content')
<div class="container mt-3">

    <h2 class="jumbotron">Create New Product</h2>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="m-4">
        @csrf
        <div class="form-group row">
            <label for="productTitle" class="col-md-4">Product Title</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="title"
                id="productTitle"
                placeholder="Enter Product Title"
                value="{{ old('title') }}">
        </div>
        <div class="form-group row">
            <label for="productShort" class="col-md-4">Short Description</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="short"
                id="productShort"
                placeholder="Enter Short Description"
                value="{{ old('short') }}">
        </div>
        <div class="form-group row">
            <label for="productPrice" class="col-md-4">Product Price</label>
            <input
                type="number"
                class="form-control col-md-8"
                name="price"
                id="productPrice"
                placeholder="Enter Product Price"
                value="{{ old('price') }}">
        </div>
        <div class="form-group row">
            <label for="productUnit" class="col-md-4">Mesurment Unit</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="unit"
                id="productUnit"
                placeholder="Enter Mesurment Unit for Product"
                value="{{ old('unit') }}">
        </div>
        <div class="form-group row">
            <label for="productDetail" class="col-md-4">Detailed Description</label>
            <textarea
                class="form-control col-md-8"
                name="detail"
                rows="4"
                id="productDetail"
                placeholder="Enter Detailed Description">{{old('detail')}}</textarea>
        </div>
        <div class="form-group row">
            <label for="productImage" class="col-md-4">Product Thumbnail Image</label>
            <div class="col-md-8 pl-0">
                <input type="file" class="form-control-file" name="image" id="productImage">
            </div>
        </div>

        <div class="form-group mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary px-3 ml-0">Cancel</a>
            <input type="reset" class="btn btn-outline-secondary px-3 mx-1"></a>
            <input type="submit" class="btn btn-outline-primary px-3"></a>
        </div>

    </form>

</div>
@endsection
