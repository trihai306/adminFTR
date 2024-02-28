<?php

namespace Future\Messages\Http\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_conversations');
    }

    //lấy tin nhắn cuối cùng của cuộc trò chuyện
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    public function userConversations()
    {
        return $this->hasMany(UserConversation::class);
    }
}
