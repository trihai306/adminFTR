<div class="col-12 col-lg-7 col-xl-9 " x-data="chatComponent" x-init="init()" id="chat"
     x-on:message-sent="handleMessageSent($event.detail)" x-on:change-conversation.window="scrollToBottom()">
    @if($user)
        <div class="card position-relative" wire:ignore.self id="conversation">
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
                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0
                                 1 -15 -15a2 2 0 0 1 2 -2"></path>
                        </svg>
                        Phone
                    </a>
                    @include('future::messages.components.profile',['user' => $user])
                </div>
            </div>
            @include('future::messages.chat',['messages' => $messages])
        </div>
    @endif
    <emoji-picker style="position: absolute;z-index: 99999;top: 35%;left: 59%;display: none"></emoji-picker>
</div>
@script
<script>
    Alpine.data('chatComponent', () => ({
        init() {
            this.scrollToBottom();
            this.listenForMessages();
        },
        createChatItem(message, senderName, senderAvatar, isUser, time, type, attachmentUrl) {
            const chatItem = document.createElement('div');
            chatItem.className = 'chat-item';
            chatItem.innerHTML = `
        <div class="row align-items-end ${isUser ? 'justify-content-end' : ''}">
            ${isUser ? '' : createAvatarColumn(senderAvatar, senderName)}
            <div class="col col-lg-6">
                <div class="chat-bubble ${isUser ? 'chat-bubble-me' : ''}">
                    <div class="chat-bubble-title">
                        <div class="row">
                            <div class="col chat-bubble-author">${senderName}</div>
                            <div class="col-auto chat-bubble-date">${time}</div>
                        </div>
                    </div>
                    <div class="chat-bubble-body">
                        <p>${message ?? ''}</p>
                        ${this.checkType(type, attachmentUrl)}
                    </div>
                </div>
            </div>
            ${isUser ? this.createAvatarColumn(senderAvatar, senderName) : ''}
        </div>
    `;
            return chatItem;
        },
        createAvatarColumn(avatar, name) {
            return `
        <div class="col-auto">
            <span class="avatar" style="${avatar ? `background-image: url(${avatar})` : ''}">
                ${avatar ? '' : name[0]}
            </span>
        </div>
    `;
        },
        handleMessageSent(e) {
            e = e[0]
            let chatItem = this.createChatItem(e.message.content, e.message.sender.name, e.message.sender.avatar,
                e.message.sender.id == {{ Auth::user()->id }}, e.message.created_at, e.message.type,
                e.message.attachment_url);
            document.getElementById('chat-bubbles').appendChild(chatItem);
            this.scrollToBottom();

        },
        checkType(type, attachments) {
            if (!attachments) return '';

            const createAttachmentHtml = (attachments, wrapperClass, renderFunction) => {
                const attachmentHtml = attachments.map(renderFunction).join('');
                return `<div class="${wrapperClass}">${attachmentHtml}</div>`;
            };

            switch (type) {
                case 'files':
                    return createAttachmentHtml(attachments, 'list-group list-group-flush mt-3 list-group-hoverable',
                        file => `
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar">${file.type[0]}</span>
                            </div>
                            <div class="col text-truncate">
                                <a href="#" class="text-reset d-block">${file.name}</a>
                            </div>
                            <div class="col-auto">
                                <a href="${file.url}" class="list-group-item-actions">
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
                `);
                case 'images':
                    return createAttachmentHtml(attachments, 'mt-3 row',
                        image => `<div class="col-auto"><img src="${image}" class="img-fluid rounded" alt="${image}"></div>`);
                case 'videos':
                    return createAttachmentHtml(attachments, 'mt-3 row',
                        video => `
                    <div class="col-auto">
                        <video controls src="${video}" class="img-fluid rounded"></video>
                    </div>
                `);
                case 'audios':
                    return createAttachmentHtml(attachments, 'mt-3 row',
                        audio => `
                    <div class="col-auto">
                        <audio controls src="${audio}" class="img-fluid rounded"></audio>
                    </div>
                `);
                default:
                    return '';
            }
        },
        scrollToBottom() {
            document.getElementById('body-scroll').scrollTo(0, document.getElementById('body-scroll').scrollHeight);
        },
        listenForMessages() {
            window.Echo.private(`App.Models.User.{{Auth::user()->id}}`)
                .listen('UserMessageEvent', (e) => {
                    var sender = e.sender;
                    var message = e.message;
                    var messagesConversationId = message.conversation_id;
                    let params = new URLSearchParams(window.location.search);
                    let conversationId = params.get('conversationId');
                    $wire.dispatch('message-sent');
                    if (messagesConversationId == conversationId) {
                        let chatItem = this.createChatItem(message.content, sender.name, sender.avatar,
                            false, message.created_at);
                        document.getElementById('chat-bubbles').appendChild(chatItem);
                    }
                });
        },
        loadMore() {
            $wire.loadMore().then(() => {
                this.$nextTick(() => {
                    const chatContainer = document.getElementById('body-scroll');
                    if (chatContainer) {
                        chatContainer.scrollTo(0, 200);
                    }
                });
            });
        }

    }));


</script>
@endscript
