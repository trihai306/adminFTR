<div class="card-body" x-data="loginForm">
    <h2 class="h2 text-center mb-4">{{ __('auth.login_to_your_account') }}</h2>
    <form x-on:submit.prevent="submit">
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('auth.email_address') }}</label>
            <input id="email" type="email" wire:model="email" class="form-control form-control-rounded
             @error('email') is-invalid @enderror" placeholder="{{__('auth.your_email_address') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label" for="password">
                {{ __('auth.password') }}
                <span class="form-label-description">
                    <a href="{{route('forgot-password')}}" wire:navigate>{{ __('auth.i_forgot_password') }}</a>
                  </span>
            </label>
            <div class="mb-3">
                <input id="password" type="password" wire:model="password" class="form-control form-control-rounded
                 @error('password') is-invalid @enderror" placeholder="{{__('auth.your_password') }}">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-2">
            <label class="form-check" for="remember-me">
                <input id="remember-me" type="checkbox" class="form-check-input"/>
                <span class="form-check-label">{{ __('auth.remember_me_on_this_device') }}</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn rounded rounded-5 btn-primary w-100" wire:loading.attr="disabled">
                <span>
                    {{ __('auth.sign_in') }}
                </span>
            </button>
        </div>
    </form>
</div>

@script
<script>
    Alpine.data('loginForm', () => ({
        email: '',
        password: '',
        submit() {
            $wire.login()
        }
    }));
</script>
@endscript
