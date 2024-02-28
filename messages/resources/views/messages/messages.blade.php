<div class="col-12 col-lg-7 col-xl-9 " id="chat">
    @if($user)
        <div class="card position-relative" wire:ignore.self id="conversation" conversation="{{$conversationId}}">
            <div class="card-header">
                <div>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if($user->avatar)
                                <span class="avatar" style="background-image: url({{asset($user->avatar)}})"></span>
                            @else
                                <span class="avatar">
                                    {{ $user->name[0] }}
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-title">{{$user->name}}</div>
                            <div class="card-subtitle">{{$user->type}}</div>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                        </svg>
                        Phone
                    </a>
                    @include('future::messages.components.profile',['user' => $user])
                </div>
            </div>
            <div class="card-body d-flex flex-column">
                @if($messages)
                    <div class="card-body scrollable" style="height: 35rem ; display: flex;
    flex-direction: column-reverse;
    overflow-y: auto;">
                        <div class="chat">
                            @if($messages->total() > 10 && $messages->currentPage() < $messages->lastPage())
                                <div class="chat-bubbles mb-3" x-data="{}" x-intersect="$wire.loadMore()">
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
                                                                    @dd(json_decode($message['attachment_url']))
                                                                    @foreach(json_decode($message['attachment_url']) as $file)
                                                                        <div class="col-auto">
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <img
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <video
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <audio
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <img
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <video
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                                                                            <a href="{{asset('storage/'.$file->url)}}"
                                                                               class="list-group-item-actions">
                                                                                <audio
                                                                                    src="{{asset('storage/'.$file->url)}}"
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
                    @livewire('future::messages.create-message', ['conversationId' => $conversationId, 'userId' => $user->id])
                @else
                    <div class="card-body scrollable" style="height: 35rem ; display: flex;
    flex-direction: column-reverse;
    overflow-y: auto;">
                        <div class="chart">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <emoji-picker style="position: absolute;z-index: 99999;top: 35%;left: 59%;display: none"></emoji-picker>
</div>
@script
<script>
    $wire.on('messageSent', (e) => {
        e = e[0].message;
        console.log(e);
        let modalElement = document.getElementById('uploadModal');
        let modalBackdrop = document.querySelector('.modal-backdrop');
        let modalInstance = new bootstrap.Modal(modalElement);
        if (modalElement.classList.contains('show')) {
            modalInstance.hide();
            modalElement.style.display = 'none';
            modalBackdrop.style.display = 'none';
        }
        let chatItem = createChatItem(e.content, e.sender.name, e.sender.avatar, e.sender.id === {{Auth::user()->id}}, e.created_at, e.type,e.attachment_url);
        document.getElementById('chat-bubbles').appendChild(chatItem);
    });

    function createChatItem(message, senderName, senderAvatar, isUser, time, type, attachment_url) {
        var rowClass = isUser ? 'row align-items-end justify-content-end' : 'row align-items-end';
        var chatBubbleClass = isUser ? 'chat-bubble chat-bubble-me' : 'chat-bubble';
        var avatarStyle = senderAvatar ? `style="background-image: url(${senderAvatar})"` : '';
        var avatarContent = senderAvatar ? '' : senderName[0];
        var avatarColumn = isUser ? '<div class="col-auto"><span class="avatar" ' + avatarStyle + '>' + avatarContent + '</span></div>' : '';
        var fileHTML = checkType(type, attachment_url) ?? '';
        var chatItem = `
        <div class="chat-item">
            <div class="${rowClass}">
                 ${isUser ? '' : avatarColumn}
                <div class="col col-lg-6">
                    <div class="${chatBubbleClass}">
                        <div class="chat-bubble-title">
                            <div class="row">
                                <div class="col chat-bubble-author">${senderName}</div>
                                <div class="col-auto chat-bubble-date">${time}</div>
                            </div>
                        </div>
                        <div class="chat-bubble-body">
                            <p>${message ?? ''}</p>
                            ${fileHTML}
                        </div>
                    </div>
                </div>
                 ${isUser ? avatarColumn : ''}

            </div>
        </div>
    `;
        var parser = new DOMParser();
        var doc = parser.parseFromString(chatItem, 'text/html');
        chatItem = doc.body.firstChild;
        return chatItem;
    }

    function checkType(type, attachment_url) {
        let attachments = attachment_url;
        // Check the type of the message
        switch (type) {
            case 'files':
                // Render file message
                let fileHTML = attachments.map(file => {
                    return `
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#"><span class="avatar">${file.type}</span></a>
                            </div>
                            <div class="col text-truncate">
                                <a href="#" class="text-reset d-block">${file.name}</a>
                            </div>
                            <div class="col-auto">
                                <a href="${file.url}" class="list-group-item-actions">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 20l16 0"/>
                                        <path d="M12 14l0 -10"/>
                                        <path d="M12 14l4 -4"/>
                                        <path d="M12 14l-4 -4"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                }).join('');
                return `<div class="list-group list-group-flush mt-3 list-group-hoverable">${fileHTML}</div>`;
            case 'images':
                // Render image message
                let imageHTML = attachments.map(image => {
                    return `
                    <div class="col-auto">
                        <img src="${image.url}" class="img-fluid rounded" alt="...">
                    </div>
                `;
                }).join('');
                return `<div class="mt-3 row">${imageHTML}</div>`;
            case 'videos':
                // Render video message
                let videoHTML = attachments.map(video => {
                    return `
                    <div class="col-auto">
                   <video src="${video.url}" class="img-fluid rounded" alt="..."></video>
                    </div>
                `;
                }).join('');
                return `<div class="mt-3 row">${videoHTML}</div>`;
            case 'audios':
                // Render audio message
                let audioHTML = attachments.map(audio => {
                    return `
                    <div class="col-auto">
                      <audio src="${audio.url}" class="img-fluid rounded" alt="..."></audio>
                    </div>
                `;
                }).join('');
                return `<div class="mt-3 row">${audioHTML}</div>`;
            default:
                return;
        }
    }


    window.Echo.private(`App.Models.User.{{Auth::user()->id}}`)
        .listen('UserMessageEvent', (e) => {
            let modalElement = document.getElementById('uploadModal');
            let modalInstance = new bootstrap.Modal(modalElement);
            if (modalElement.classList.contains('show')) {
                modalInstance.hide();
            }
            var sender = e.sender;
            var message = e.message;
            var messagesConversationId = message.conversation_id;
            //lấy conversationId bằng params url
            var ConversationId = document.getElementById('conversation').getAttribute('conversation');
            if (messagesConversationId == ConversationId) {
                let chatItem = createChatItem(message.content, sender.name, sender.avatar, sender.id === {{Auth::user()->id}}, message.created_at);
                document.getElementById('chat-bubbles').appendChild(chatItem);
            }
        });
</script>
@endscript
