@extends('layouts.admin')

@section('content')
    <!--Section: List Categories -->
    <section class="mb-4">
        <div class="card">
            <div class="card-header text-center py-3">
                <h3 class="mb-0 text-center">
                    <strong>List Pages</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $prod)
                                <tr onclick="location.href='{{ config('tie.admin_prefix') }}/page/{{ $prod->id }}'" role="button">
                                    <th scope="row">{{ $prod->title }}</th>
                                    <td>{{ $prod->slug }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
