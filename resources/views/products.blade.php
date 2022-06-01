<x-layout header="header-v4">

    <x-flash-message type='danger' />
    <x-title-page title="Produk" />
    <x-product-list title="" :categories="$categories" :products="$products" />

</x-layout>
