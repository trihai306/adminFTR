<?php
namespace Future\Form\Future\Traits;
trait NotificationTrait {
    protected function notificationOk($message) {
        $this->dispatch('swalSuccess', ['message' => $message]);
    }

    protected function notificationError($message) {
        $this->dispatch('swalError', ['message' => $message]);
    }
}
