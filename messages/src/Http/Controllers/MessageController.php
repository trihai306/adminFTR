<?php
namespace Future\Messages\Http\Controllers;

use App\Http\Controllers\Controller;
use Future\Messages\Http\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $conversationId = $request->get('conversationId') ?? null;
        $conversation = Conversation::find($conversationId);
        if (!$conversation) {
          $conversationId = null;
        }
        return view('future::chat', compact('conversationId'));
    }
}
