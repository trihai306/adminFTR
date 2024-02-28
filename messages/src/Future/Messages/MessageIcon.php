<?php

namespace Future\Messages\Future\Messages;

use Future\Messages\Http\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class MessageIcon extends Component
{
    public $count;
    public $userId;
    public $page = 10;

    public function mount()
    {
        $user = auth()->user();
        $this->count = $user->getUnreadMessages()->count();
        $this->userId = $user->id;
    }

    public function getListeners()
    {
        return [
            "echo-private:messages.{$this->userId},MessageSent" => 'refreshCount',
        ];
    }
    #[On('messageSent')]
    public function render()
    {
        $conversations = $this->getConversations();
        return view('future::messages.icon', compact('conversations'));
    }

    protected function refreshCount()
    {
        $user = auth()->user();
        $this->count = $user->getUnreadMessages()->count();
    }

    public function loadMore()
    {
        $this->page += 10;
    }

    protected function getConversations()
    {
        $user = auth()->user();
        $lastMessageSub = Message::select('conversation_id', \DB::raw('MAX(created_at) as last_message_at'))
            ->groupBy('conversation_id');

        $conversations = $user->conversations()
            ->joinSub($lastMessageSub, 'last_messages', function ($join) {
                $join->on('conversations.id', '=', 'last_messages.conversation_id');
            })
            ->with(['users' => function ($query) use ($user) {
                $query->where('id', '!=', $user->id);
            }, 'lastMessage'])
            ->orderBy('last_messages.last_message_at', 'desc')
            ->fastPaginate($this->page);

        return $conversations;
    }
}
