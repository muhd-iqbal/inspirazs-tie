@foreach ($vars as $var)
    <form action="/admin/var/{{ $var->id }}" method="POST">
        @csrf
        <div>
            <p>{{ $var->name }}</p>
            <input type="text" name="description" id="description" value="{{ $var->description }}">
            <button type="submit">Simpan</button>
        </div>
    </form>
@endforeach

<div>
    <p>Tambah Variable</p>
    <form action="/admin/var" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="Nama Variable" value="{{ old('name') }}">
        <input type="text" name="description" id="description" placeholder="Value" value="{{ old('description') }}">
        <button type="submit">Tambah</button>
    </form>
</div>
