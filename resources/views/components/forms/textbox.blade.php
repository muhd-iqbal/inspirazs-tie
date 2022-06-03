@props(['nm', 'lb', 'req' => false, 'col', 'type'=>'text'])
<div class="form-group col-sm-{{ $col }} flex-column d-flex">
    <label class="form-control-label">{{ $lb }}
        @if ($req)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type }}" id="{{ $nm }}" name="{{ $nm }}" value="{{ session($nm)? session($nm):old($nm) }}" {{ $req ? "required": ""}}>
    @error($nm)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
