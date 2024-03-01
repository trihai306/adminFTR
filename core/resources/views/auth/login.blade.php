@extends('future::layouts.auth')
@section('content')
    <div class="container container-tight py-4">
        <div class="card card-md border-3 rounded rounded-5"> <!-- Add rounded-lg here -->
            <livewire:future::auth.login></livewire:future::auth.login>
        </div>

    </div>
@endsection
