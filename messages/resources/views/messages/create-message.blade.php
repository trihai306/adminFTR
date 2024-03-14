<div>
    <div class="modal fade" wire:ignore id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered rounded rounded-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">File Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush list-group-hoverable" id="list-file">
                    </div>
                    <textarea
                        class="form-control mt-4"
                        placeholder="Write a message..."
                        wire:model="message"
                        wire:keydown.enter="sendFile"
                    ></textarea>
                </div>
                <div class="modal-footer">
                    <button wire:click="sendFile" wire:target="files" wire:loading.remove type="button"
                            class="btn w-100 btn-primary">Send
                    </button>
                    <button wire:target="files" wire:loading type="button" class="btn w-100 btn-primary" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        upload files...
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group input-group-flat">
        <input type="file" multiple id="fileUpload" wire:model="files" class="form-control"
               style="display: none;"
               x-on:change="handleFiles($event.target.files)" accept=".doc,.docx,.xls,.xlsx,image/*">
        <label for="message"></label><textarea class="form-control @error('message') is-invalid @enderror" id="message"
                                               wire:model="message"
                                               autocomplete="off"
                                               placeholder="Type message"
                                               style="resize: none; overflow: auto; height: 100%;"></textarea>
        <span class="input-group-text">
                        <a href="#" class="link-secondary" id="icon"  data-bs-toggle="tooltip" aria-label="icon"
                           data-bs-original-title="icon"> <!-- Download SVG icon from http://tabler-icons.io/i/mood-smile -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                               viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                               stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none"></path><path
                                  d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 10l.01 0"></path><path
                                  d="M15 10l.01 0"></path><path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path></svg>
                        </a>
                        <a href="#" onclick="document.getElementById('fileUpload').click();" class="link-secondary ms-2"
                           data-bs-toggle="tooltip" aria-label="Thêm file"
                           data-bs-original-title="Add file"> <!-- Download SVG icon from http://tabler-icons.io/i/paperclip -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                               viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                               stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none"></path><path
                                  d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"></path></svg>
                        </a>
                        <button type="button" class="btn btn-primary ms-2" wire:click="sendMessage">Send</button>
                      </span>
    </div>
</div>
@script
<script>
    let textarea = document.querySelector('#message');
    let pickerOld = document.querySelector('emoji-picker');
    document.querySelector('emoji-picker')
        .addEventListener('emoji-click', event => {
            textarea.value += event.detail.unicode;
            $wire.set('message', textarea.value);
        });
</script>
@endscript
