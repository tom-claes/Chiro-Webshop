@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
    <div class="item-box">
        <img src="" alt="">
        <img class="item-img" src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}">
        <div class="item-right-side">
            <p class="item-name">{{$product->name}}</p>
            <p class="item-description">{{$product->description}}</p>
            <p class="item-size">{{$product->sizeSort->name}}</p>
            <p class="item-price">{{"€" . $product->price}}</p>

            <form method="POST" action="{{route('shop.add.toCart', ['productId' => $product->id])}}">
                @csrf
                <div class="form-div">
                    <x-input-label  for="size" :value="__('Maat')" />
                    <x-dropdown-form id="size" name="size" class="block mt-1 w-full" required autofocus autocomplete="size">
                        <option disabled selected></option>
                
                        @foreach($product->sizes as $size)
                            <option {{ $size->pivot->stock == 0 ? 'disabled' : '' }} value="{{ $size->id }}">{{ $size->size }} @if($size->pivot->stock == 0) <p>(Niet in stock)</p> @endif </option>             <!-- Zorgt ervoor dat je een maat dat niet in stock is niet in de winkelmand kan zetten-->
                        @endforeach
                    </x-dropdown-form>
                    <x-input-error :messages="$errors->get('size')" class="mt-2" />
                    <p id="stock"></p>
                </div>

                <x-primary-button>In winkelmandje</x-primary-button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('size').addEventListener('change', function() {
            var sizeId = this.value;
            fetch('/stock/' + sizeId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('stock').innerText = 'Stock: ' + data.stock;
                });
        });
    </script>
@endsection