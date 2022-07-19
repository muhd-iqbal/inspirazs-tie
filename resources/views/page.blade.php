<x-layout header="header-v4" title="{{ $page->title }}" keywords="{{ $page->keywords }}"
    description="{{ $page->description }}">
    <style>
        h5 {
            padding: 1rem;
        }
    </style>
    <x-title-page title="{{ $page->title }}" />
    <!-- breadcrumb -->
    <div class="container mb-3">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Utama
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $page->title }}
            </span>
        </div>
    </div>
    <!-- Shoping Cart -->
    <div class="container m-b-50">
        <div class="row">
            <div class="p-5">
                {!! $page->body !!}
            </div>
        </div>
    </div>
</x-layout>
