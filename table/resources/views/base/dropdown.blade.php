<div class='dropdown'>
    <button class='btn align-text-top dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close="outside">{{
        __('future::messages.actions')}}</button>
    <div class='dropdown-menu'>
        @foreach($actions as $action)
          {{$action->render()}}
        @endforeach
    </div>
</div>
