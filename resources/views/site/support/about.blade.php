@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">About</h2>
</div>
<p class="centered h2 underline">Chiro Zuun Webshop</p>

<br>

<div class="support-page">
    <p class="about-subtitle">Inhoudstabel:</p>
    <p><a class="underline link" href="#uitleg">1.Uitleg van het project</a></p>
    <p><a class="underline link" href="#technologien">2.Technologiën</a></p>
    <p><a class="underline link" href="#initialiseren">3.Hoe dit project initialiseren</a></p>
    <p><a class="underline link" href="#accounts">4.Accounts</a></p>
    <p><a class="underline link" href="#admin">5.Admin</a></p>
    <p><a class="underline link" href="#opgelet">6.Let Op</a></p>
    <p><a class="underline link" href="#relaties">7.Relaties</a></p>
    <p><a class="underline link" href="#bronnen">8.Bronnen</a></p>
    <p><a class="underline link" href="#github">9.Github</a></p>
    
    
    <br>
    
    <p id="uitleg" class="about-subtitle">Uitleg van het project:</p>
    <p>Het dient niet zozeer als een webshop maar eerder een manier om stock bij te houden en bestellingen op voorhand klaar te leggen. </p>
    <p>De klant zal niet moeten betalen voor de producten via de website en producten worden ook niet verzonden. Bestellingen zullen klaarliggen voor de ouders op chiro zondagen en ouders betalen nog steeds zoals nu met payconiq.</p>
    <p>Bij het aankopen van de producten zal de bestelling van de stock worden afgetrokken en zal iemand met een admin account de bestellingen kunnen zien.</p>
    <p>Hierdoor zullen ouders weten welke maten niet meer beschikbaar zijn en zal dit voor de leiding niet steeds een zoektocht zijn van 1 maat in een doos vol andere maten. De prijzen liggen ook vast, dus de leider moet geen kennis hebben van de prijzen en weten direct de prijs die de ouder moet betalen.</p>
    
    <br>
    
    <p id="technologien" class="about-subtitle">Technologiën:</p>
    <p>- Laravel</p>
    <p>- Laravel Breeze (+ dependencies)</p>
    <p>- Alpine.js</p>
    <p>- Bootstrap</p>
    
    <br>
    
    <p id="initialiseren" class="about-subtitle">Hoe dit project initialiseren:</p>
    <p>1. Instaleer composer door in de terminal van het project het commando: '<span class="underline delete">composer i</span>' uit te voeren.</p>
    <p>2. Instaleer npm door in de terminal van het project het commando: '<span class="underline delete">npm i</span>' uit te voeren.</p>
    <p>3. Maak een database genaamd "chiro-webshop" aan.</p>
    <p>4. Voer in de terminal van het project het commando: '<span class="underline delete">php artisan migrate:fresh --seed</span>' uit.</p>
    <p>5. Link de storage aan de public directory door in de terminal het commando: '<span class="underline delete">php artisan storage:link</span>' uit te voeren.</p>
    
    <br>
    
    <p id="accounts" class="about-subtitle">Accounts:</p>
    <p>De initiële account: "chirozuun@gmail.com" (admin), "tom.claes@gmail.com" (non-admin), "niel.rogiers@gmail.com" (non-admin) hebben als wachtwoord: "wachtwoord".</p>
    <p>Het initiële EhB account: "admin@ehb.be" heeft als wachtwoord: "Password!321".</p>
    
    <br>
    
    <p id="admin" class="about-subtitle">Admin:</p>
    <p>Naar het admin paneel navigeren:</p>
    <p>1. Druk op het account icoon rechts boven en klik op login, of surf naar: <a href="http://127.0.0.1:8000/login" class="link underline">http://127.0.0.1:8000/login</a>.</p>
    <p>2. Log in met je admin account.</p>
    <p>3. Eens je bent ingelogd druk je op het account icoon rechts boven en in de dropdown op "Admin Dashboard".</p>
    
    <br>
    
    <p id="opgelet" class="about-subtitle">Let op:</p>
    <p>Het account van gebruikers zijn enkel zichtbaar via het admin paneel, dus gebruikers kunnen elkaar niet opzoeken. Het is een webshop en leek daarom niet logisch, meneer Felix Kevin was het hier ook akkoord mee.</p>
    
    <br>
    
    <p id="relaties" class="about-subtitle">Relaties:</p>
    <p>Mijn 1-to-many relatie: de relatie tussen faq en zijn faq categorie. Een faq behoort maar tot 1 categorie, maar een categorie kan meerdere faq's hebben.</p>
    <p>Mijn many-to-many relatie: de relatie tussen product en size model. 1 product kan meerdere sizes hebben en een size kan ook behoren tot meerdere producten.</p>
    
    <br>
    
    <p id="bronnen" class="about-subtitle">Bronnen:</p>
    <p>- Voor de admin sidebar: <a href="https://codepen.io/t7team/pen/bGBzQZZ" class="link underline">https://codepen.io/t7team/pen/bGBzQZZ</a></p>
    <p>- Voor de vuilbak in de winkelwagen: <a href="https://codepen.io/LocalPCGuy/pen/bvVgQJ" class="link underline">https://codepen.io/LocalPCGuy/pen/bvVgQJ</a></p>
    
    <br>
    
    <p id="github" class="about-subtitle">Github:</p>
    <p>Link: <a href="https://github.com/tom-claes/Chiro-Webshop" class="link underline">https://github.com/tom-claes/Chiro-Webshop</a></p>
    @endsection
</div>