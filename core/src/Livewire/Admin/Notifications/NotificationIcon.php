<?php

namespace Future\Core\Livewire\Admin\Notifications;

use Livewire\Component;

class NotificationIcon extends Component
{
    public $count;
    public $userId;

    public function mount()
    {
        $user = auth()->user();
        $this->userId = $user->id;
        $this->count = $user->unreadNotifications->count();
    }

    public function getListeners()
    {
        return [
            'ReadNotification' => 'loadCount',
            "echo-private:App.Models.User.{$this->userId},UserNotification" => "loadCount",
        ];
    }

    public function render()
    {
        return view('future::livewire.admin.notifications.icon', ['count' => $this->getCount()]);
    }

    public function getCount()
    {
        return $this->count > 99 ? '99+' : $this->count;
    }

    public function loadCount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }
}
