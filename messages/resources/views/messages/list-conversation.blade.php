<div class="col-12 col-lg-5 col-xl-3 border-end">
    <div class="card-header d-none d-md-block" style="padding: 20px 16px">
        <div class="input-group">
            <input type="text" wire:model.live.debounce.400ms="search" value="" class="form-control" placeholder="Search…"
                   aria-label="Search">
            <a href="#" class="pt-2 ps-2" data-bs-toggle="modal" data-bs-target="#createConversation">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                    <path d="M16 19h6"/>
                    <path d="M19 16v6"/>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"/>
                </svg>
            </a>
            <div class="modal fade" wire:ignore.self id="createConversation" tabindex="-1"
                 aria-labelledby="createConversationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createConversationLabel">Create Conversation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="createConversation">
                                <div class="mb-3 " x-data="{ search: '', open: false }">
                                    <label for="user-search" class="form-label">Recipient</label>
                                    <div class="input-icon">
                                        <input
                                            type="text"
                                            id="user-search"
                                            x-model="search"
                                            class="form-control"
                                            placeholder="Search recipient..."
                                            @focus="open = true"
                                            wire:model.live.debounce.500ms="searchUser"
                                            autocomplete="off"
                                        >
                                        <span class="input-icon-addon" >
                                          <div class="spinner-border spinner-border-sm text-secondary" wire:loading wire:target="searchUser" role="status"></div>
                                        </span>
                                    </div>
                                    <ul x-show="open" class="list-group overflow-auto" wire:target="searchUser"
                                        style="max-height: 200px">
                                        @foreach($users as $user)
                                            @if(str_contains(strtolower($user->name), strtolower($search)))
                                                <li
                                                    class="list-group-item list-group-item-action"
                                                    x-on:click="search = '{{ str_replace("'", "\\'", $user->name) }}'; open = false; $wire.set('user', '{{ $user->id }}')"
                                                >
                                                    {{ $user->name }}
                                                </li>
                                            @endif
                                        @endforeach
                                        @if($users->total() > 10 && $users->currentPage() < $users->lastPage())
                                            <li class="list-group-item" x-data="{}" x-intersect="$wire.loadMoreUser()">
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
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary w-100"  data-bs-dismiss="modal" aria-label="Close">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0 scrollable" style="max-height: 80vh">
        <div class="nav flex-column nav-pills" wire:poll.30s role="tablist">
            @foreach($conversations as $conversation)
                <a href="#chat-{{$conversation->id}}" x-on:click="$wire.changeConversation({{$conversation->id}})"
                   class="nav-link text-start mw-100 p-3
                   @if($conversationId == $conversation->id)
                          active
                   @endif
                   " data-bs-toggle="pill" role="tab" aria-selected="true">
                    <div class="row align-items-center flex-fill">
                        <div class="col-auto">
                            @if($conversation->users[0]->avatar)
                                <span class="avatar"
                                      style="background-image: url({{ asset($conversation->users[0]->avatar) }})"></span>
                            @else
                                <span class="avatar">
                                    {{ $conversation->users[0]->name[0] }}
                                </span>
                            @endif
                        </div>
                        <div class="col text-body">
                            <div>{{ $conversation->users[0]->name }}</div>
                            <div class="text-secondary text-truncate w-100">
                                {{$conversation->lastMessage->content}}
                            </div>
                            <small class="text-secondary">
                                {{$conversation->lastMessage->created_at->diffForHumans()}}
                            </small>
                        </div>
                    </div>
                </a>
            @endforeach
            @if($conversations->total() > 10 && $conversations->currentPage() < $conversations->lastPage())
                <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 d-block">
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

