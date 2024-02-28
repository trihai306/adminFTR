<?php

namespace Future\Messages\Future\Messages;

use App\Models\User;
use Future\Messages\Http\Models\Conversation;
use Future\Messages\Http\Models\Message;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Computed;

class ListConversation extends Component
{
    public $search;
    public $page = 10;
    public $searchUser;
    public $pageUser = 10;

    public $user;
    #[Locked]
    public $conversationId = null;

    public function mount($conversationId = null)
    {
        $this->conversationId = $conversationId;
    }

    #[Computed('search', 'page')]
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
            ->whereHas('users', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            // Sắp xếp dựa trên 'last_message_at' từ subquery
            ->orderBy('last_messages.last_message_at', 'desc')
            ->fastPaginate($this->page);

        return $conversations;
    }


    public function loadMoreUser()
    {
        $this->pageUser += 10;
    }

    public function loadMore()
    {
        $this->page += 10;
    }

    public function changeConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->dispatch('changeConversation', $conversationId);
    }

    public function createConversation()
    {
        try {
            $this->validate([
                'user' => 'required|exists:users,id',
            ]);
            $user = auth()->user();
            $newUser = User::find($this->user);
            $conversation = $user->conversations()->whereHas('users', function ($query) use ($newUser) {
                $query->where('id', $newUser->id);
            })->first();
            if (!$conversation) {
                $conversation = conversation::create([
                    'type' => 'private',
                ]);
                // Attach the users to the conversation
                $conversation->users()->attach([$user->id, $newUser->id]);
            }
            $this->conversationId = $conversation->id;
            $this->dispatch('changeConversation', $this->conversationId);
        }catch (\Exception $e){
            $this->dispatch('notification', [
                'title' => 'Error',
                'message' => $e->getMessage(),
                'time' => now()->timestamp,
            ]);
        }
    }

    #[On('messageSent')]
    public function render()
    {
        if ($this->searchUser) {
            $users = User::where('name', 'like', '%' . $this->searchUser . '%')->paginate($this->pageUser);
        } else {
            $users = User::paginate($this->pageUser);
        }
        return view('future::messages.list-conversation',
            [
                'conversations' => $this->getConversations(),
                'users' => $users,
            ]);
    }
}
