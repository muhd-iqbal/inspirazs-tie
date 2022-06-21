@extends('layouts.admin')

@section('content')

    <div class="p-5">
        <a href="/admin">Back to dashboard</a>
        <div class="table-responsive mb-5">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Save</th>
                </tr>
                @foreach ($vars as $var)
                    <tr>
                        <form action="/admin/var/{{ $var->id }}" method="POST">
                            @csrf
                            <td>
                                {{ $var->name }}:
                            </td>
                            <td class="flex-1">
                                <input type="text" name="description" id="description" value="{{ $var->description }}">
                            </td>
                            <td>
                                <button type="submit">Save</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="border">
            <p>Add Variable</p>
            <form action="/admin/var" method="POST">
                @csrf
                <input type="text" name="name" id="name" placeholder="Variable Name" value="{{ old('name') }}">
                <input type="text" name="description" id="description" placeholder="Value / Description"
                    value="{{ old('description') }}">
                <button type="submit">Add</button>
            </form>
            <small class="text-danger">Added variables cannot be deleted</small>
        </div>

    </div>
    <script>alert('Be careful, changing this may break the website.')</script>

@endsection
