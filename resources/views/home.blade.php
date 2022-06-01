<x-layout>

    <!-- Slider -->
    <x-main-slider />

    <!-- Banner -->
    <x-section-banner :categories="$categories" />

    <!-- Product -->
    <x-product-list title=" Produk ditawarkan" :categories="$categories" :products="$products" />

</x-layout>
