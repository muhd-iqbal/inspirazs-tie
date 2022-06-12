@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white">

        <h2>Produk ID: {{ $product->id }}</h2>
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form class="" method="POST" action="/admin/product/{{ $product->id }}"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" />
                        <label class="form-label" for="name">Product name *</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="price" name="price" class="form-control"
                            value="{{ RM($product->price) }}" />
                        <label class="form-label" for="price">Price (RM)</label>
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="keywords" name="keywords" class="form-control"
                    value="{{ $product->keywords }}" />
                <label class="form-label" for="keywords">Keywords *</label>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="weight" name="weight" class="form-control"
                            value="{{ $product->weight }}" />
                        <label class="form-label" for="weight">Product weight</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="dimensions" name="dimensions" class="form-control"
                            value="{{ $product->dimensions }}" />
                        <label class="form-label" for="dimensions">Dimension</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="materials" name="materials" class="form-control"
                            value="{{ $product->materials }}" />
                        <label class="form-label" for="materials">Material</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="size" name="size" class="form-control" value="{{ $product->size }}" />
                        <label class="form-label" for="size">Size</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="category" class="form-control" value="{{ $product->category->name }}"
                            disabled />
                        <label class="form-label" for="material">Category</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="active" name="active" class="form-control"
                            value="{{ $product->active }}" />
                        <label class="form-label" for="active">Active - 1 / No - 0 *</label>
                    </div>
                </div>
            </div>

            <small class="mb-4 text-danger">Generate html, copy dan paste here. <a href="https://wordtohtml.net/"
                    target="_blank">CLICK HERE</a></small>

            <div class="form-outline mb-4">
                <textarea class="form-control" id="desc_short" name="desc_short" rows="4">{{ $product->desc_short }}</textarea>
                <label class="form-label" for="desc_short">Short Description</label>
            </div>

            <div class="form-outline mb-4">
                <textarea class="form-control" id="desc_long" name="desc_long" rows="4">{{ $product->desc_long }}</textarea>
                <label class="form-label" for="desc_long">Long Description</label>
            </div>

            <small class="mb-4 text-danger">For optimum result use image resolution 1200px X 1485px</small>

            <div class="mb-4">
                <label class="form-label" for="image">Featured Picture * <a
                        href="{{ asset('storage/products/' . $product->picture) }}" target="_blank">VIEW</a></label>
                <input type="file" class="form-control" id="picture" name="picture" value="{{ $product->picture }}" />
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">Update Product</button>
        </form>

        <div class="mt-5">
            <div class="d-flex justify-content-between">
                <h3>Photos</h3>
                <form action="/admin/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" id="photo">

                    <button type="submit" class="btn btn-warning">Tambah</button>
                </form>
            </div>

            @foreach ($product->images as $img)
                <img src="{{ asset('storage/products' . $img->path) }}" class="img-thumbnail"
                    alt="Image for {{ $product->name }}">
            @endforeach
        </div>
    @endsection
