@extends('layouts.admin')

@section('content')

    <div class="p-5 bg-white">
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
        <form action="{{ config('tie.admin_prefix') }}/slider/{{ $slider->id }}" method="POST" class="mb-4" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-4 row">
                <div class="col">
                    <label class="form-label" for="product_id">Product</label>
                    <select name="product_id" id="product_id" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $slider->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label class="form-label" for="active">Active</label>
                    <select name="active" id="active" class="form-control">
                        <option value="0" {{ $slider->active ? '' : 'selected' }}>No</option>
                        <option value="1" {{ $slider->active ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>
            <div class="form-outline mb-4">
                <input type="subtitle" id="subtitle" class="form-control" name="subtitle"
                    value="{{ $slider->subtitle }}" />
                <label class="form-label" for="subtitle">Sub Title</label>
            </div>
            <div class="mb-4">
                <label class="form-label" for="image">Image (1920 X 930 px)</label>
                <input type="file" class="form-control" id="image" name="image" />
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </form>
        <div class="mb-4">
            <img src="{{ asset('storage/sliders/' . $slider->image) }}" class="img-thumbnail" height="200"
                alt="">
        </div>
    @endsection
