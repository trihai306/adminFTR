<div class="container">
    <div class="row">
        @foreach ($stats as $stat)
            <div class="col-md-{{ $stat->col ?? '3' }}">
                {{ $stat->render() }}
            </div>
        @endforeach
    </div>
</div>
