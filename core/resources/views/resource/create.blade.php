@extends('future::layouts.app')
@section('content')
    <!--begin::Content-->
    <div  class="content flex-row-fluid">
        <!--begin::Card-->
        @livewire($form, ['id' => null,'url'=>request()->route()->getName()])
        <!--end::Card-->
    </div>
    <!--end::Content-->
@endsection
@section('script')

@endsection
