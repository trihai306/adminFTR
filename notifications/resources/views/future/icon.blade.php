<div class="nav-item d-none d-md-flex">
<a href="#" class="btn nav-link px-0 me-3 ms-3" data-bs-toggle="offcanvas"
   data-bs-target="#notification" aria-controls="offcanvasRight"
   wire:click="$dispatch('showNotifications')">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
         stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"fill="none"/>
        <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
        <path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
    <span class="badge bg-primary text-white badge-notification badge-pill">{{$count}}</span>
</a>
</div>
