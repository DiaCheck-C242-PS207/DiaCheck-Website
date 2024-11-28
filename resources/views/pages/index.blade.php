@extends('layouts.main')

@section('content')
    <h1>Selamat Datang!</h1>
    <ul class="navbar-nav mx-0" id="dropdown">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#"
                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-image">
                    @if (!empty(Auth::user()->avatar))
                        <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                    @elseif (!empty(Auth::user()->avatar_google))
                        <img class="img" src="{{ Auth::user()->avatar_google }}">
                    @else
                        <img class="img"
                            src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                    @endif
                </div>
                <span class="nav-text text-color">&nbsp;{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item {{ $active == 'my profile' ? 'active' : '' }}"
                        href="#">My Profile</a>
                </li>
                <li>
                    <hr class="dropdown-divider py-0 my-1">
                </li>
                <li>
                    <a id="logout-confirmaton" class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); logout();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
@endsection
