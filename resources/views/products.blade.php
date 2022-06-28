<x-layout header="header-v4" title="Senarai Produk">

    <x-flash-message type='danger' />
    <x-title-page title="Produk" />
    <x-product-list title="" :categories="$categories" :products="$products" />

</x-layout>
