@extends('layouts.admin')

@section('content')
    <div class="p-4 bg-white">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Sub</th>
                    <th>Image</th>
                    <th>Active?</th>
                </tr>
            </thead>
            {{-- <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </td>
                </tr>
            </tfoot> --}}
            <tbody>
                @foreach ($sliders as $slider)
                    <tr valign="middle" onclick="location.href='/admin/slider/{{ $slider->id }}'" role="button">
                        <th>{{ $slider->product->name }}</th>
                        <td>{{ $slider->subtitle }}</td>
                        <td>
                            <img src="{{ asset('storage/sliders/' . $slider->image) }}" height="100" />
                        </td>
                        <td>
                            {{ $slider->active ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
