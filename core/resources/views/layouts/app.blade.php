<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <title>FUTURE</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/pikaday.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/libs/star-rating.js/dist/star-rating.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css?v={{ time() }}"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="{{ asset('dist/css/demo.min.css') }}?v={{ time() }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/app.css') }}?v={{ time() }}" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @livewireStyles

</head>
<body class="position-relative">
<script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
<div class="page">
    @include('future::app.header')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
        @include('future::app.footer')
        @livewire('future::livewire.admin.notifications')

    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/js/app.js','resources/css/app.css'])
<script data-navigate-once src="{{ asset('dist/js/tabler.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/js/demo.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/js/custom.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/libs/nouislider/dist/nouislider.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
<script data-navigate-once src="{{asset('dist/js/pikaday.js')}}"></script>
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"
        integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script data-navigate-once src="{{ asset('dist/libs/star-rating.js/dist/star-rating.min.js') }}"></script>
@include('future::components.scripts.swal')
@include('future::components.scripts.toast')
@yield('script')
@livewireScripts
</body>
</html>
