@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-form-heading">Contact</p>

<form method="GET" action="{{ route('admin.contact') }}" class="flex">
    <x-text-input type="text" name="search" placeholder="Zoek contactformulier" value="{{ request()->query('search') }}"/>
    <x-primary-button type="submit" class="self-stretch">Zoek</x-primary-button>
</form>

<table>
    <thead>
        <tr>
            <th>Verzender</th>
            <th>Email</th>
            <th>Onderwerp</th>
            <th>Datum</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($contactForms as $form)
            <tr>
                <td>{{ ucwords($form->lastname) . " " . ucwords($form->firstname) }}</td>
                <td>{{ $form->email }}</td>
                <td>{{ ucfirst($form->subject) }}</td>
                <td>{{ $form->created_at->format('d-m-Y (H:i)') }}</td>
                <td><button class="myButton" data-target="#message-{{ $loop->index }}">Zie Bericht <i class="arrow right"></i></button></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            &#x22EE;
                        </button>
                        <ul class="dropdown-menu">
                        <li><form method="POST" action="{{ route('admin.delete.contactform', $form->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item delete">Verwijder</button>
                            </form></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr id="message-{{ $loop->index }}" style="display: none;">
                <td colspan="6">{{ $form->message }}</td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.myButton').on('click', function() {
        var target = $(this).data('target');
        $(target).toggle();
    });
});
</script>
@endsection