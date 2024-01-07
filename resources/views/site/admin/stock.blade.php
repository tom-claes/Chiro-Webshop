@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <p class="stock-product-name">{{ $product->name }}</p>
    <p class="stock-product-size-sort">{{ $product->sizeSort->name }}</p>


    <div class="stock-page">

        <img class="stock-img" src="{{ asset($product->img) }}" alt="Profiel foto">

       <div class="stock-sizes">
           @forelse ($product->sizes as $size)
               <div class="stock-size">
                   <form method="POST" action="{{route('admin.update.stock', ['productId' => $product->id, 'sizeId' => $size->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="stock-form-input">
                            <x-input-label for="stock" :value="__('Maat: ' . $size->size)" />
                            <x-text-input id="stock" style="color:black;" class="block mt-1 w-full" type="number" name="stock" :value="$size->pivot->stock ? $size->pivot->stock  : 0 " autofocus autocomplete="stock" />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                        <x-primary-button class="stock-form-btn">
                            {{ __('Update') }}
                        </x-primary-button> 
                   </form>
               </div>
           @empty
           
           @endforelse
       </div>
    </div>
@endsection