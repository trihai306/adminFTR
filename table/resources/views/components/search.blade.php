<label>
    <input type="text" class="form-control form-control-rounded form-control-solid  ps-13"
           wire:model.live.debounce.300ms="search"
           placeholder="{{ __('future::messages.search') }}"/>
    <span class="input-icon-addon">
                              <div class="spinner-border spinner-border-sm text-secondary" wire:loading
                                   wire:target="search" role="status"></div>
                                  <svg xmlns="http://www.w3.org/2000/svg" wire:loading.class="d-none"
                                       wire:target="search" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                            d="M0 0h24v24H0z"
                                                                                            fill="none"></path><path
                                          d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path
                                          d="M21 21l-6 -6"></path></svg>
                                </span>
</label>
