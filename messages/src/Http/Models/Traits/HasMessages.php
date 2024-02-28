<?php

namespace Future\Messages\Http\Models\Traits;

use Future\Messages\Http\Models\Conversation;
use Future\Messages\Http\Models\Message;
use Future\Messages\Http\Models\MessageReaction;
use Future\Messages\Http\Models\UserConversation;

trait HasMessages
{
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messageReactions()
    {
        return $this->hasMany(MessageReaction::class);
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userConversations()
    {
        return $this->hasMany(UserConversation::class, 'user_id');
    }

    /**
     * Define a many-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'user_conversations');
    }

    /**
     * Get the number of unread messages for the user.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUnreadMessages()
    {
        $unreadMessages = collect();

        $user = auth()->user();
        $userConversations = $user->userConversations();
        foreach ($userConversations as $userConversation) {
            $lastSeenMessageId = $userConversation->last_seen_message_id;
            $messages = $userConversation->conversation->messages()->where('id', '>', $lastSeenMessageId)->get();
            $unreadMessages = $unreadMessages->concat($messages);
        }

        return $unreadMessages;
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
