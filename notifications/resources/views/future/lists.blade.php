@php use Carbon\Carbon; @endphp
<div id="notification" class="bg-body offcanvas offcanvas-end" wire:ignore.self tabindex="-1"
     aria-labelledby="offcanvasRightLabel">
    @if($notifications->count() > 0)
        <div class="offcanvas-header">
            <h3 class="mt-2">Thông báo</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
        <div id="rv_activities_scroll" class="position-relative ">
            <div class="list-group" style="max-height: 76vh;">
                    @foreach($notifications as $notification)
                    <div class="list-group-item" wire:click="markAsRead('{{$notification->id}}')"
                         wire:key="{{$notification->id}}" style="cursor: pointer;">
                        <div class="pe-3">
                            <div class="mb-2 d-flex justify-content-between">
                                <h4>
                                    {{$notification->data['title']}}
                                </h4>
                                <span class="fs-5">{{Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                            </div>
                            <div class="d-flex align-items-center mt-1">
                                <div class="{{ is_null($notification->read_at) ? '' : 'text-secondary' }} me-2">
                                    {{$notification->data['content']}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($notifications->total() > 10 && $notifications->currentPage() < $notifications->lastPage())
                        <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 h-10px d-block">
                            <ul class="list-group list-group-flush placeholder-glow">
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar avatar-rounded placeholder"></div>
                                        </div>
                                        <div class="col-7">
                                            <div class="placeholder placeholder-xs col-9"></div>
                                            <div class="placeholder placeholder-xs col-7"></div>
                                        </div>
                                        <div class="col-2 ms-auto text-end">
                                            <div class="placeholder placeholder-xs col-8"></div>
                                            <div class="placeholder placeholder-xs col-10"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif

            </div>
        </div>
    </div>
        <div class="offcanvas-footer text-center">
            <button wire:click="readAll" wire:loading.remove
                    class="btn btn-bg-body text-primary"> Đánh dấu tất cả đã đọc</button>
            <button wire:loading wire:target="readAll" class="btn btn-bg-body text-primary" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Đang xử lý...
            </button>
        </div>
    @else
        <div class="offcanvas-body p-0">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="text-center">
                    <div class="mb-2">
                        <!-- Tabler Icon for bell -->
                        <i class="fa fa-bell" style="font-size: 48px;"></i>
                    </div>
                    <h3>No notifications</h3>
                    <p class="text-muted">Please check again later.</p>
                </div>
            </div>
        </div>
    @endif
</div>
