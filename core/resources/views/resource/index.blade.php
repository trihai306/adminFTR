@extends('future::layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content flex-row-fluid">
        <!--begin::Card-->
        @livewire($table)

        <!--end::Card-->
    </div>
    <!--end::Content-->
@endsection
