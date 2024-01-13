<div style="padding: 10px;">
    <p style="font-size: 200%; font-weight: bold;">Danku voor u aankoop #{{ $details['Bestel Nummer'] }}</p>
    
    <p><span style="font-weight: bold;">Totaal: </span>{{"€" . $details['Totaal'] }}</p>

    <br>
    
    <div style="box-shadow: var(--light-grey) 2px 2px 10px; width: 500px; height: 150px; padding: 10px; margin-bottom: 10px;">
        @foreach ($details['Producten'] as $key => $product)
            <div style="{{ $key == 0 ? 'margin-top: 0;' : 'margin-top: 5px;' }}">
                <p><span style="font-weight: bold;"> {{ $product['Naam'] }} </span>, <span style="font-weight: bold;">Aantal:</span> {{ $product['Aantal'] }}, <span style="font-weight: bold;">Maat:</span> {{ $product['Maat'] }}</p>
            </div>
        @endforeach
    </div>
    
    <br>
    
    <p>U kan uw bestelling elke Chiro zondag komen ophalen om 14u, 17u of 18u.</p>
    <p>De leiding van Chiro Zuun</p>
</div>