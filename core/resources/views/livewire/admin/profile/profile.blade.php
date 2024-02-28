<div class="col-12 col-md-9 d-flex flex-column">
    <form>
        <div class="card-body">
            <h2 class="mb-4">{{ __('future::profile.my_account') }}</h2>
            <h3 class="card-title">{{ __('future::profile.profile_details') }}</h3>
            <div class="row align-items-center">
                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('static/avatars/001f.jpg') }})"></span></div>
                <div class="col-auto">
                    <label class="btn" for="avatarUpload">
                        {{ __('future::profile.change_avatar') }}
                    </label>
                    <input type="file" id="avatarUpload" accept="image/*" wire:model="avatar" style="display: none;">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.profile') }}</h3>
            <div class="row g-3">
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.name') }}</div>
                    <p class="form-control">{{ Auth::user()->name ?? 'chưa có tên' }}</p>
                </div>
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.phone') }}</div>
                    <p class="form-control">{{ Auth::user()->phone ?? 'chưa có số điện thoại' }}</p>
                </div>
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.birthday') }}</div>
                    <p class="form-control">{{ Auth::user()->birthday ?? 'chưa cập nhập ngày' }}</p>
                </div>
            </div>

            <h3 class="card-title mt-4">{{ __('future::profile.email') }}</h3>
            <p class="card-subtitle">{{ __('future::profile.email_subtitle') }}</p>
            <div>
                <div class="row g-2">
                    <div class="col-auto">
                        <input type="text" class="form-control w-auto" wire:model="email" value="{{ auth()->user()->email }}">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn" wire:click="updateEmail">
                            {{ __('future::profile.change') }}
                        </button>
                    </div>
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.password') }}</h3>
            <p class="card-subtitle">{{ __('future::profile.password_subtitle') }}</p>
            <div>
                <a href="#" class="btn">
                    {{ __('future::profile.set_new_password') }}
                </a>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-start">
                <button type="submit" class="btn btn-primary">
                    {{ __('future::profile.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
