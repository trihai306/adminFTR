<?php

namespace Future\Messages\Http\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Conversation\app\Models\Message;


class MessagePolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return $user->HasRole('admin');
    }

    public function show(User $user = null, Message $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return false;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, Message $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Message $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Message $model): bool
    {
        return false;
    }

    public function delete(User $user, Message $model): bool
    {
        return false;
    }
}
