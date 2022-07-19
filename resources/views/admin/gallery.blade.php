@extends('layouts.admin')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="p-5 bg-white">

            <div class="d-flex justify-content-between">
                <h2>Gallery Photo </h2>
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
            <form class="" method="POST" action="{{ config('tie.admin_prefix') }}/gallery"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="customFile">Add to gallery</label>
                    <input type="file" name="img" class="form-control" id="customFile" />
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Upload</button>
            </form>


            <h1 class="fw-light text-center text-lg-start mt-4 mb-0">List of Picture</h1>
            <small>Click to copy link to photo </small>

            <hr class="mt-2 mb-5">

            <div class="row text-center text-lg-start">
                @foreach ($gallery as $gal)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="d-block mb-4 h-100" role="button" onclick="copyToClipboard({{ $gal->id }})">
                            <img class="img-fluid img-thumbnail" id="{{ $gal->id }}"
                                src="{{ asset('storage/photos/' . $gal->img_path) }}" alt="{{ $gal->id }}">
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <script>
            function copyToClipboard(id) {
                copyText = document.getElementById(id).src;
                navigator.clipboard.writeText(copyText);
                alert('Link copied!\n' + copyText)
            }
        </script>

    @endsection
