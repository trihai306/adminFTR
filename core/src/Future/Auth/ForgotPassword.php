<?php

namespace Future\Core\Future\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public function sendResetLinkEmail()
    {
        $this->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function render()
    {
        return view('future::future.auth.forgot-password');
    }
}
