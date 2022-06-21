@props(['alert', 'style'])
<div id="alertModal" class="modal fade d-flex justify-content-center" style="z-index: 2000">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content {{ $style }}">
            <div class="modal-body text-center">
                <p>{{ $alert }}</p>
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
            </div>
        </div>
    </div>
</div>
