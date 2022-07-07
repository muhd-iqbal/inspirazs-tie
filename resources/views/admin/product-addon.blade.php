@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white">

        <div class="d-flex justify-content-between">
            <h2>Addon for: {{ $product->name }} <a href="{{ config('tie.admin_prefix') }}/product/{{ $product->id }}"
                    class="btn btn-warning">Kembali</a></h2>
        </div>
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

        <h4 class="text-center mb-4">
            Add addon
        </h4>

        <form action="{{ config('tie.admin_prefix') }}/product/{{ $product->id }}/addon" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            required />
                        <label class="form-label" for="name">Addon Name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="price" name="price" class="form-control"
                            value="{{ old('price') }}" required />
                        <label class="form-label" for="price">Price</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary mb-4">Add</button>
            </div>
        </form>

        @if ($product->addon)
            <h4 class="text-center mb-4">
                Edit addon
            </h4>

            @foreach ($product->addon as $add)
                <form action="{{ config('tie.admin_prefix') }}/product/{{ $product->id }}/addon/{{ $add->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $add->name }}" required />
                                <label class="form-label" for="name">Addon Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="price" name="price" class="form-control"
                                    value="{{ RM($add->price, '') }}" required />
                                <label class="form-label" for="price">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mb-4">Edit</button>
                    </div>
                </form>
            @endforeach
        @endif

    @endsection
