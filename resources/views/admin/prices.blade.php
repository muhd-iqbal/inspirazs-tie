@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white">

        <div class="d-flex justify-content-between">
            <h2>Price for product: {{ $product->name }} <a href="/admin/product/{{ $product->id }}"
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
            Add Price Tier
        </h4>

        <form action="" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col text-center">
                    Quantity
                </div>
                <div class="col text-center">
                    Price
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="min" name="min" class="form-control" value="{{ old('min') }}"
                            required />
                        <label class="form-label" for="min">From</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="max" name="max" class="form-control" value="{{ old('max') }}"
                            required />
                        <label class="form-label" for="max">To</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="cash" name="cash" class="form-control" value="{{ old('cash') }}"
                            required />
                        <label class="form-label" for="cash">Cash Price</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="loan" name="loan" class="form-control" value="{{ old('loan') }}"
                            required />
                        <label class="form-label" for="loan">Loan Price</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary mb-4">Add</button>
            </div>
        </form>

        <h4 class="text-center mb-2">Modify Price Here </h4>
        @foreach ($prices as $price)
            <form action="/admin/price/{{ $price->id }}" method="POST" id="form-update-{{ $price->id }}">
                @csrf
                @method('PATCH')
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="min" name="min" class="form-control" value="{{ $price->min }}" />
                            <label class="form-label" for="min">From</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="max" name="max" class="form-control" value="{{ $price->max }}" />
                            <label class="form-label" for="max">To</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="cash" name="cash" class="form-control"
                                value="{{ RM($price->cash) }}" />
                            <label class="form-label" for="cash">Cash</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="loan" name="loan" class="form-control"
                                value="{{ RM($price->loan) }}" />
                            <label class="form-label" for="loan">Loan</label>
                        </div>
                    </div>
                </div>
            </form>
            <form action="/admin/price/{{ $price->id }}" method="POST" id="form-delete-{{ $price->id }}">
                @csrf
                @method('DELETE')
            </form>
            <div class="d-flex justify-content-end mb-4">
                <!-- Submit button -->
                <button type="submit" class="btn btn-danger mx-2" form="form-delete-{{ $price->id }}"
                    onclick="return confirm('Confirm Delete Price?')">Delete</button>
                <button type="submit" class="btn btn-primary" form="form-update-{{ $price->id }}">Update</button>
            </div>
        @endforeach
    @endsection
