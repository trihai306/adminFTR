<?php

namespace Future\Messages\Future\Messages;

use Future\Messages\Http\Models\Conversation;
use Future\Messages\Http\Models\Message;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Messages extends Component
{
    #[Url]
    #[Locked]
    public $conversationId;
    public $page = 10;
    public $message = '';

    public function mount($conversationId = null)
    {
        $this->conversationId = $conversationId;
    }

    #[On('changeConversation')]
    public function changeConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->page = 10;
    }

    public function getListeners()
    {
        return [
            "echo-private:messages.{$this->conversationId},MessageSent" => 'refreshMessages',
        ];
    }

    protected function getMessages()
    {
        return Message::with(['sender'])
            ->where('conversation_id', $this->conversationId)
            ->orderByDesc('created_at');
    }

    public function loadMore()
    {
        $this->page += 10;
    }

    public function render()
    {
        $user = null;
        $messages = [];
        if ($this->conversationId) {
            $user = Conversation::find($this->conversationId)->users()->where('id', '!=', auth()->user()->id)->first();
            $conversation = auth()->user()->conversations()->findOrFail($this->conversationId);

            $messages = $conversation->when($conversation->exists(), function () {
                return $this->getMessages()->fastPaginate($this->page);
            }, function () {
                return [];
            });
        }

        return view('future::messages.messages', compact('messages', 'user'));
    }
}
