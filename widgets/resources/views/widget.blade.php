<div class="card"
    @foreach ($extraAttributes as $key=>$value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="bg-{{$color}} text-white avatar">
                    @svg($descriptionIcon, 'icon')
                </span>
            </div>
            <div class="col">
                <div class="font-weight-medium">
                    {{ $title }}
                </div>
                <div class="text-secondary">
                    {{ $description }}
                </div>
            </div>
        </div>
    </div>
</div>
