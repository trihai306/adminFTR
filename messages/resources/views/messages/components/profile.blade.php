<a href="#offcanvasEnd" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasEnd" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square" width="24" height="24"
         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
         stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 9h.01"/>
        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"/>
        <path d="M11 12h1v4h1"/>
    </svg>
    Thông tin
</a>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasEndLabel">Thông tin tài khoản</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-center">
        @if($user->avatar)
            <span class="avatar" style="background-image: url({{asset($user->avatar)}});width: 70%;height: 200px"></span>
        @else
            <h2 class="avatar" style="width: 70%;height: 200px;font-size: 40px">{{ $user->name[0] }}</h2>
        @endif
        <h1 class="my-3">{{$user->name}}</h1>
        <h3 class="text-muted mb-1">{{$user->type}}</h3>
    </div>
</div>
