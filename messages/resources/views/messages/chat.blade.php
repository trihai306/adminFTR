<div class="card-body d-flex flex-column" wire:poll.keep-alive.60s>
    @if($messages->count() > 0)
        <div class="card-body d-flex flex-column"  id="body-scroll" style="height: 34rem;
                     flex-direction: column-reverse; overflow-y: auto;">
            <div class="chat">
                @if($messages->total() > 10 && $messages->currentPage() < $messages->lastPage())
                    <div class="chat-bubbles mb-3" x-intersect="loadMore()">
                        <div class="chat-item mt-5">
                            <div class="row align-items-end">
                                <div class="col-auto">
                                                <span class="avatar">
                                                    <div class="placeholder bg-secondary"
                                                         style="width: 50px; height: 50px;"></div>
                                                </span>
                                </div>
                                <div class="col col-lg-6">
                                    <div class="chat-bubble">
                                        <div class="chat-bubble-title">
                                            <div class="row">
                                                <div class="col chat-bubble-author">
                                                    <div class="placeholder-glow">
                                                        <span class="placeholder bg-secondary"
                                                              style="width: 400px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto chat-bubble-date">
                                                    <div class="placeholder-glow">
                                                        <span class="placeholder bg-secondary"
                                                              style="width: 400px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-bubble-body">
                                            <div class="placeholder-glow">
                                                            <span class="placeholder bg-secondary"
                                                                  style="width: 100%;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="chat-bubbles" id="chat-bubbles">
                    @foreach($messages->reverse() as $message)
                        @if($message->sender->id == Auth::user()->id)
                            <div class="chat-item">
                                <div class="row align-items-end justify-content-end">
                                    <div class="col col-lg-6">
                                        <div class="chat-bubble chat-bubble-me" style="">
                                            <div class="chat-bubble-title">
                                                <div class="row">
                                                    <div
                                                        class="col chat-bubble-author">{{$message->sender->name}}</div>
                                                    <div
                                                        class="col-auto chat-bubble-date">{{$message->created_at->diffForHumans() }} </div>
                                                </div>
                                            </div>
                                            <div class="chat-bubble-body">
                                                @if($message->type == 'text')
                                                    <p>
                                                        {{$message->content}}
                                                    </p>
                                                @elseif($message->type == 'files')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div
                                                        class="list-group list-group-flush mt-3 list-group-hoverable">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="list-group-item">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <a href="#">
                                                                                        <span
                                                                                            class="avatar">{{$file->type}}</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col text-truncate">
                                                                        <a href="#"
                                                                           class="text-reset d-block">{{$file->name}}</a>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="{{asset('storage/'.$file->url)}}"
                                                                           class="list-group-item-actions">
                                                                           <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler
                                                                                 icon-tabler-arrow-bar-to-down"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24"
                                                                                stroke-width="2"
                                                                                stroke="currentColor"
                                                                                fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path stroke="none"
                                                                                      d="M0 0h24v24H0z"
                                                                                      fill="none"/>
                                                                                <path d="M4 20l16 0"/>
                                                                                <path d="M12 14l0 -10"/>
                                                                                <path d="M12 14l4 -4"/>
                                                                                <path d="M12 14l-4 -4"/>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'images')
                                                    <p>{{$message->content ?? ''}}</p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <img
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'videos')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <video
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                    </video>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'audios')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <audio
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                    </audio>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        @if($message->sender->avatar)
                                            <span class="avatar"
                                                  style="background-image: url({{ asset($message->sender->avatar) }})"></span>
                                        @else
                                            <span class="avatar">{{ $message->sender->name[0] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="chat-item">
                                <div class="row align-items-end">
                                    <div class="col-auto">
                                        @if($message->sender->avatar)
                                            <span class="avatar"
                                                  style="background-image: url({{ asset($message->sender->avatar) }})"></span>
                                        @else
                                            <span class="avatar">{{ $message->sender->name[0] }}</span>
                                        @endif
                                    </div>
                                    <div class="col col-lg-6">
                                        <div class="chat-bubble">
                                            <div class="chat-bubble-title">
                                                <div class="row">
                                                    <div
                                                        class="col chat-bubble-author">{{$message->sender->name}}</div>
                                                    <div
                                                        class="col-auto chat-bubble-date">{{$message->created_at->diffForHumans() }} </div>
                                                </div>
                                            </div>
                                            <div class="chat-bubble-body">
                                                @if($message->type == 'text')
                                                    <p>
                                                        {{$message->content}}
                                                    </p>
                                                @elseif($message->type == 'files')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div
                                                        class="list-group list-group-flush mt-3 list-group-hoverable">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="list-group-item">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <a href="#">
                                                                                        <span
                                                                                            class="avatar">{{$file->type}}</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col text-truncate">
                                                                        <a href="#"
                                                                           class="text-reset d-block">{{$file->name}}</a>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="{{asset('storage/'.$file->url)}}"
                                                                           class="list-group-item-actions">
                                                                            <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                                            <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-arrow-bar-to-down"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24"
                                                                                stroke-width="2"
                                                                                stroke="currentColor"
                                                                                fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path stroke="none"
                                                                                      d="M0 0h24v24H0z"
                                                                                      fill="none"/>
                                                                                <path d="M4 20l16 0"/>
                                                                                <path d="M12 14l0 -10"/>
                                                                                <path d="M12 14l4 -4"/>
                                                                                <path d="M12 14l-4 -4"/>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'images')
                                                    <p>{{$message->content ?? ''}}</p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <img
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'videos')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <video
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                    </video>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($message->type == 'audios')
                                                    <p>
                                                        {{$message->content ?? ''}}
                                                    </p>
                                                    <div class="mt-3 row">
                                                        @foreach(json_decode($message['attachment_url']) as $file)
                                                            <div class="col-auto">
                                                                <a href="{{asset($file)}}"
                                                                   class="list-group-item-actions">
                                                                    <audio
                                                                        src="{{asset($file)}}"
                                                                        class="img-fluid rounded"
                                                                        alt="...">
                                                                    </audio>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @livewire('future::messages.create-message', ['conversationId' => $conversationId])
    @else
        <div class="card-body scrollable" style="height: 35rem ; display: flex;
                            flex-direction: column-reverse;
                            overflow-y: auto;">
            <div class="chart">
            </div>
        </div>
    @endif
</div>
