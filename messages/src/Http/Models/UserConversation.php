<?php

namespace Future\Messages\Http\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserConversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'conversation_id', 'date_joined', 'last_seen_message_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function lastSeenMessage()
    {
        return $this->belongsTo(Message::class, 'last_seen_message_id');
    }

    /**
     * Get the count of unread messages for the conversation.
     *
     * @return int
     */
    public function getUnreadMessagesCount()
    {
        $lastSeenMessageId = $this->last_seen_message_id;

        // Get the count of Message records in the conversation that have an ID greater than the last_seen_message_id
        $unreadMessagesCount = $this->conversation->messages()->where('id', '>', $lastSeenMessageId)->count();

        return $unreadMessagesCount;
    }

}
