@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="admin-create">
    <div class="admin-show-table">
        <div class="admin-show-nav">

                <p>{{ $product->name }}</p>
                <p>{{ $product->sizeSort->name }}</p>
                @forelse ($product->sizes as $size)
                    <form method="POST" action="{{route('admin.update.stock', ['productId' => $product->id, 'sizeId' => $size->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="form-div">
                            <x-input-label for="stock" style="color: #FFF;" :value="__($size->size)" />
                            <x-text-input id="stock" style="color:black;" class="block mt-1 w-full" type="number" name="stock" :value="$size->pivot->stock" autofocus autocomplete="stock" />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                        <x-primary-button class="admin-form-btn">
                            {{ __('Update stock') }}
                        </x-primary-button>
                    </form>

                @empty
                @endforelse

            
        </div>
        
    </div>
</div>
@endsection