<div class='dropdown'>
    <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown'>{{
        __('future::messages.actions')}}</button>
    <div class='dropdown-menu'>
        @foreach($actions as $action)
          {{
            $action->render()
}}
        @endforeach
    </div>
</div>
