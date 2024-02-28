<?php
namespace Future\Messages\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Conversation\app\Models\UserConversation;

class UserConversationPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, UserConversation $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function storeBulk(User $user): bool
    {
        return true;
    }

    public function update(User $user, UserConversation $model): bool
    {
        return true;
    }

    public function updateBulk(User $user, UserConversation $model): bool
    {
        return true;
    }

    public function deleteBulk(User $user, UserConversation $model): bool
    {
        return true;
    }

    public function delete(User $user, UserConversation $model): bool
    {
        return true;
    }
}
