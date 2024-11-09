// resources/views/products/show.blade.php
@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>

    <p>Product ID: {{ $product->product_id }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <p>Stock: {{ $product->stock }}</p>
    @if($product->image)
        <p><img src="{{ $product->image }}" alt="{{ $product->name }}"></p>
    @endif

    <a href="{{ route('products.edit', $product->id) }}">Edit</a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
