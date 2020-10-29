@extends('layouts.master')

@section('content')
<div class="container mt-3">

    <div class="jumbotron d-flex justify-content-between">
        <h2>Edit Product</h2>
        <form class="form-inline" method="POST" action="{{ route('products.destroy', $product->slug) }}">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-sm btn-outline-light text-danger px-3" value="Delete">
        </form>
    </div>

    <form
        method="POST"
        action="{{ route('products.update', $product->slug) }}"
        enctype="multipart/form-data"
        class="m-4">
        @csrf
        @method('PUT')

        <!-- Product Title -->
        <div class="form-group row">
            <label for="productTitle" class="col-md-4">Product Title</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="title"
                id="productTitle"
                placeholder="Enter Product Title"
                value="{{ (old('title')) ?? $product->title }}">
        </div>

        <!-- Product Short Description -->
        <div class="form-group row">
            <label for="productShort" class="col-md-4">Short Description</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="short"
                id="productShort"
                placeholder="Enter Short Description"
                value="{{ (old('short')) ?? $product->short }}">
        </div>

        <!-- Product Price -->
        <div class="form-group row">
            <label for="productPrice" class="col-md-4">Product Price</label>
            <input
                type="number"
                class="form-control col-md-8"
                name="price"
                id="productPrice"
                placeholder="Enter Product Price"
                value="{{ (old('price')) ?? $product->price }}">
        </div>

        <!-- Product Mesurment Unit -->
        <div class="form-group row">
            <label for="productUnit" class="col-md-4">Mesurment Unit</label>
            <input
                type="text"
                class="form-control col-md-8"
                name="unit"
                id="productUnit"
                placeholder="Enter Mesurment Unit for Product"
                value="{{ (old('unit')) ?? $product->unit }}">
        </div>

        <!-- Product Detailed Description -->
        <div class="form-group row">
            <label for="productDetail" class="col-md-4">Detailed Description</label>
            <textarea
                class="form-control col-md-8"
                name="detail"
                rows="4"
                id="productDetail"
                placeholder="Enter Detailed Description">{{(old('detail'))??$product->detail}}</textarea>
        </div>

        <!-- Product Image -->
        <div class="form-group row">
            <label for="productImage" class="col-md-4">Product Thumbnail Image</label>
            <div class="col-md-8 pl-0">
                <input
                    type="file"
                    class="form-control-file"
                    name="image"
                    id="productImage">
                <small class="form-text text-muted">On selection previous image will be replaced by this new image.</small>
            </div>
        </div>

        <!-- Product Archive -->
        <div class="form-group row">
            <label class="col-md-4" for="productArchive">Archive Product</label>
            <div class="col-md-8">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="productArchive"
                    name="archive"
                    aria-label="Checkbox to toggle product archive status"
                    {{ ($product->archive) ? 'checked' : '' }}>
                <label class="form-check-label" for="productArchive">
                    Toggle the product archive status.
                </label>
            </div>
        </div>

        <!-- Cancel editing and return back  -->
        <a href="{{ URL::previous() }}" class="btn btn-outline-secondary px-4 mr-2">Cancel</a>

        <!-- Submit changes to server and save changes made to product -->
        <input type="submit" class="btn btn-outline-success px-4" value="Save"></a>

    </form>


</div>
@endsection
