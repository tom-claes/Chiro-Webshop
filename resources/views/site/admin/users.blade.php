@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
    <p class="admin-form-heading">Users</p>
    
    <form method="GET" action="{{ route('admin.users') }}" class="flex">
        <x-text-input type="text" name="search" placeholder="Search user" value="{{ request()->query('search') }}"/>
        <x-primary-button type="submit" class="self-stretch">Search</x-primary-button>
    </form>

    @if(request()->query('search'))
        <table>
            <thead>
                <tr>
                    <th>Afbeelding</th>
                    <th>Naam</th>
                    <th>Gebruikersnaam</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td><img class="admin-show-img" src="{{ asset($user->img) }}" alt="Profiel foto"></td>
                        <td>{{ $user->lastname . " " . $user->firstname}}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        @if( $user->admin == 1)
                            <td>Ja</td>
                        @else
                            <td>Nee</td>
                        @endif

                        <td>
                            <a href="{{route('admin.view.user', $user->id)}}" style="display: flex; align-items: center;">
                                Bekijk profiel
                                <img style="vertical-align: middle; margin-left: 6px;" width="13.75px" src="{{ asset('IMG\link.svg') }}" alt="Your SVG File">
                            </a>
                        </td>
                    </tr>
                @empty
                
                @endforelse
            </tbody>
        </table>
    @endif

@endsection