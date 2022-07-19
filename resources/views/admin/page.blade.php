@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white">

        <div class="d-flex justify-content-between">
            <h2>Page ID: {{ $page->id }}
                <button onclick="window.open('/page/{{ $page->slug }}','_blank')" target="_blank"
                    class="btn btn-info">Show</button>
            </h2>
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
        <form class="" method="POST" action="{{ config('tie.admin_prefix') }}/page/{{ $page->id }}" >
            @csrf
            @method('PATCH')
            <div class="row my-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title') ? old('title') : $page->title }}" />
                        <label class="form-label" for="title">Page Title *</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug') ? old('slug') : $page->slug }}" disabled />
                        <label class="form-label" for="slug">Slug</label>
                    </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="description" name="description" class="form-control"
                    value="{{ old('description') ? old('description') : $page->description }}" required />
                <label class="form-label" for="description">Short Description *</label>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="keywords" name="keywords" class="form-control"
                    value="{{ old('keywords') ? old('keywords') : $page->keywords }}" required />
                <label class="form-label" for="keywords">Keywords *</label>
            </div>

            <small class="mb-4 text-danger">Generate html, copy dan paste here. <a href="https://wordtohtml.net/"
                    target="_blank">CLICK HERE</a></small>
            <div class="form-outline mb-4">
                <textarea class="form-control" id="body" name="body" rows="15">{{ old('body') ? old('body') : $page->body }}</textarea>
                <label class="form-label" for="body">Body</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">Update Page</button>
        </form>

    @endsection
