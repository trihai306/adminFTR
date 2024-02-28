<?php
namespace Future\Messages\Future\Messages;

use App\Events\UserMessageEvent;
use Future\Messages\Http\Models\Message;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CreateMessage extends Component
{
    public $message;
    use WithFileUploads;
    public $files;
    #[Locked]
    public $conversationId;

    protected $rules = [
        'message' => 'required',
    ];
    #[Locked]
    public $userId;

    public function mount($conversationId, $userId)
    {
        $this->conversationId = $conversationId;
        $this->userId = $userId;
    }

    #[On('changeConversation')]
    public function changeConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->message = '';
    }

    public function sendMessage()
    {
        $this->validate();
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => Auth::id(),
            'content' => $this->message,
            'type' => 'text',
        ]);
        $message->load('sender');
        $this->message = '';
        $this->eventMessages($message);
    }

    public function sendFile()
    {
        try {
            $this->validate([
                'files.*' => 'max:524288,mimes:jpg,jpeg,png,gif,doc,docx,pdf,xls,xlsx,ppt,pptx,zip,rar,mp3,mp4,avi,mov,wmv,flv',
            ]);
            $filesArray = [];
            $type = 'files';
            foreach ($this->files as $file) {
                if (in_array($file->getClientOriginalExtension(), ['mp4', 'avi', 'mov', 'wmv', 'flv'])) {
                    $type = 'videos';
                }
                if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif','webp','svg'])) {
                    $type = 'images';
                }
                $filename = $file->getClientOriginalName();
                $linkFile = $file->store('public/messages/' . $this->conversationId);
                $linkFile = str_replace('public/', '', $linkFile);
                $filesArray[] = [
                    'name' => $filename,
                    'url' => $linkFile,
                    'type' => $file->getClientOriginalExtension(),
                    'sizeText' => round($file->getSize() / 1024, 2) . ' KB',
                ];
            }
            $message = Message::create([
                'conversation_id' => $this->conversationId,
                'sender_id' => Auth::id(),
                'content' => $this->message,
                'attachment_url' => json_encode($filesArray),
                'type' => $type,
            ]);
            $this->message = '';
            $message->load('sender');
            $this->eventMessages($message);
        }
        catch (\Exception $e) {
            $this->dispatch('notification', [
                'title' => 'Error',
                'message' => 'có lỗi xảy ra',
                'time' => now()->timestamp,
            ]);
        }
    }

    protected function eventMessages($message)
    {
        $messageData = [
            'id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id' => $message->sender_id,
            'content' => $message->content,
            'type' => $message->type,
            'attachment_url' => json_decode($message->attachment_url),
            'created_at' => $message->created_at->diffForHumans(),
            'sender' => $message->sender,
        ];
        event(new UserMessageEvent( $this->userId, $messageData, Auth::id()));
        $this->dispatch('messageSent', ['message' => $messageData]);
    }

    public function render()
    {
        return view('future::messages.create-message');
    }
}
