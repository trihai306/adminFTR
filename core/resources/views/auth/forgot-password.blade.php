@extends('future::layouts.auth')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        @livewire('future::forgot-password')
        <div class="text-center text-muted mt-3">
            Forget it, <a href="{{route('login')}}">send me back</a> to the sign in screen.
        </div>
    </div>
@endsection
