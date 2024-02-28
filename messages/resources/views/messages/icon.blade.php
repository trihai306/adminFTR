<div class="nav-item dropdown d-none d-md-flex">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show messages">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
             stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <polyline points="3 7 12 13 21 7"/>
        </svg>
        <span class="badge bg-primary text-white badge-notification badge-pill">{{$count}}</span>
    </a>
    <div wire:ignore.self class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <div class="card" style="width: 400px">
            <div class="card-header">
                <h3 class="card-title">Danh sách tin nhắn <span
                        class="badge text-white bg-primary ms-2">{{$count}}</span>
                </h3>
            </div>
            <div class="list-group scrollable list-group-flush list-group-hoverable" style="max-height: 35rem">
                @if($conversations)
                    @foreach($conversations as $conversation)
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                @if($conversation->users[0]->avatar)
                                        <span class="avatar avatar-sm">
                                <img src="{{ asset($conversation->users[0]->avatar) }}"
                                     alt="..."
                                     class="avatar-img rounded-circle">
                            </span>
                                    @else
                                        <span class="avatar avatar-sm">
                                     {{substr($conversation->users[0]->name, 0, 1)}}</span>
                                @endif
                                </div>
                                <div class="col
{{--                                @if($conversation->userConversations[0]->last_seen_message_id == $conversation->lastMessage->id)--}}
{{--                                font-weight-bold text-white--}}
{{--                                @endif--}}
                            ">
                                    <a href="{{ route('admin.messages.index', ['conversationId' => $conversation->id]) }}"
                                       wire:navigate class="text-body d-block">{{$conversation->users[0]->name}}</a>
                                    <div class="d-block text-muted text-truncate mt-n1">
                                        {{$conversation->lastMessage->content}}
                                    </div>
                                </div>
                                <div class="col-auto text-secondary
{{--                            @if($conversation->userConversations[0]->last_seen_message_id == $conversation->lastMessage->id)--}}
{{--                                font-weight-bold text-white--}}
{{--                                @endif--}}
                            ">
                                    <p>   {{$conversation->lastMessage->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                   @if($conversations->total() > 5 && $conversations->currentPage() < $conversations->lastPage())
                            <li class="list-group-item" x-data="{}" x-intersect="$wire.loadMore()">
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
                   @endif
                @else
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <p>Không có tin nhắn mới</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <a href="{{ route('admin.messages.index')}}" wire:navigate class="btn w-100">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
