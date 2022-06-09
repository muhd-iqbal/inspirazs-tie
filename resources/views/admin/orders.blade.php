@foreach ($orders as $order)
    <a href="{{ "/o/$order->hash/$order->id" }}">{{ $order->id }}</a>
@endforeach
