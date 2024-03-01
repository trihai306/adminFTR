<?php

namespace Future\Notifications\Future;

use Livewire\Component;

class NotiList extends Component
{
    public $page = 10;

    public function getListeners()
    {
        return [
           'showNotifications' => 'render',
            'reloadNotification' => 'render'
        ];
    }

    public function render()
    {
        $notifications = auth()->user()->notifications()->paginate($this->page);
        return view('future::future.lists', compact('notifications'));
    }

    public function loadMore()
    {
        $this->page = $this->page + 10;
    }


    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
            $this->dispatch('ReadNotification');
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Đã đọc thông báo']);
            return;
        }
        $this->dispatch('showToast', ['type' => 'error', 'message' => 'Không tìm thấy thông báo']);

    }

    public function readAll()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            $this->dispatch('ReadNotification');
            $this->dispatch('notification', ['type' => 'success', 'message' => 'Đã đọc tất cả thông báo']);
        }
        catch (\Exception $exception) {
            $this->dispatch('notification', ['type' => 'error', 'message' => 'Có lỗi xảy ra']);
        }
    }
}
