<div>
    <form class="card card-md" wire:submit.prevent="sendResetLinkEmail" autocomplete="off" novalidate>
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Forgot password</h2>
            <p class="text-muted mb-4">Enter your email address and your password will be reset and emailed to you.</p>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" wire:model="email" class="form-control form-control-rounded" placeholder="Enter email">
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100" wire:loading.remove wire:target="sendResetLinkEmail">
                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                    Send me new password
                </button>
                <button type="button" class="btn btn-primary w-100" wire:loading wire:target="sendResetLinkEmail" disabled>
                    <!-- Download SVG icon from http://tabler-icons.io/i/loader-refresh -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3v6m0 12v-6m-7.8 -5h6.6a2 2 0 0 1 2 2v6.2" /><path d="M12 9v-6m7.8 5h-6.6a2 2 0 0 0 -2 2v6.2" /></svg>
                    Sending...
                </button>
            </div>
        </div>
    </form>
</div>
