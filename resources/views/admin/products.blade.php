@extends('layouts.admin')

@section('content')
    <!--Section: List Categories -->
    <section class="mb-4">
        <div class="card">
            <div class="card-header text-center py-3">
                <h5 class="mb-0 text-center">
                    <strong>Latest Orders</strong>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $prod)
                                <tr onclick="location.href='/admin/product/{{ $prod->id }}'" role="button">
                                    <th scope="row">{{ $prod->name }}</th>
                                    <td>{{ $prod->slug }}</td>
                                    <td>{{ $prod->active }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--Section: List Categories -->
    <section>
        <div class="text-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                Add Product
            </button>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin/products" method="POST">
                        <div class="modal-body">
                            @csrf
                            {{-- <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" />
                                        <label class="form-label" for="form6Example1">First name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example2" class="form-control" />
                                        <label class="form-label" for="form6Example2">Last name</label>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Text input -->
                            <label class="form-label" for="name">Name</label>
                            <div class="form-outline mb-4">
                                <input type="text" id="name" name="name" class="form-control" />
                            </div>

                            <!-- Text input -->
                            <label class="form-label" for="picture">Picture (recommend 1200px x 1485px)</label>
                            <div class="form-outline mb-4">
                                <input type="file" class="form-control" id="picture" />
                            </div>

                            <!-- Email input -->
                            <label class="form-label" for="category_id">Category</label>
                            <div class="form-outline mb-4">
                                {{-- <input type="email" id="form6Example5" class="form-control" /> --}}
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
