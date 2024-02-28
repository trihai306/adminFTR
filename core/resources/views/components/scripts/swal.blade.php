<script>
    function swalAlert({
                           icon = 'info',
                           title = 'Information',
                           message = 'This is an informational alert!',
                           showCancel = false,
                           confirmText = 'Có',
                           cancelText = 'Không',
                           onYes = null,
                           onNo = null,

                       } = {}) {
        const options = {
            icon: icon,
            title: title,
            text: message,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary',
                popup: `bg-dark text-light`,
            },
        };

        if (showCancel) {
            options.showCancelButton = true;
            options.confirmButtonText = confirmText;
            options.cancelButtonText = cancelText;
            options.reverseButtons = true;
        }

        Swal.fire(options).then((result) => {
            if (result.isConfirmed && typeof onYes === 'function') {
                onYes();
            } else if (result.dismiss === Swal.DismissReason.cancel && typeof onNo === 'function') {
                onNo();
            }
        });
    }

    function swalBasic(message = 'Hello World') {
        swalAlert({message: message});
    }
    function swalSuccess(title = 'Successful', message = 'Your operation was successful!') {
        swalAlert({icon: 'success', title: title, message: message});
    }

    function swalError(title = 'Oops...', message = 'Something went wrong!') {
        swalAlert({icon: 'error', title: title, message: message});
    }

    function swalWarning(title = 'Be Careful!', message = 'You need to check this!') {
        swalAlert({icon: 'warning', title: title, message: message});
    }

    function swalInfo(title = 'Information', message = 'This is an informational alert!') {
        swalAlert({icon: 'info', title: title, message: message});
    }

    function swalQuestion(title = 'Question', message = 'Do you have any questions?') {
        swalAlert({icon: 'question', title: title, message: message});
    }

    function swalConfirm(title = 'Are you sure?', message = 'Do you want to proceed?', onYes = null, onNo = null) {
        swalAlert({icon: 'question', title: title, message: message, showCancel: true, onYes: onYes, onNo: onNo});
    }

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swalSuccess', (event) => {
            swalSuccess('Successful', event[0]['message']);
        });

        Livewire.on('swalError', (event) => {
            swalError('Oops...', event[0]['message']);
        });

        Livewire.on('swalWarning', (event) => {
            swalWarning('Be Careful!', event[0]['message']);
        });

        Livewire.on('swalInfo', (event) => {
            swalInfo('Information', event[0]['message']);
        });

        Livewire.on('swalQuestion', (event) => {
            swalQuestion('Question', event[0]['message']);
        });

        Livewire.on('swalConfirm', (event) => {
            function onYes() {
                var params =  {id: event['id']};
                if(event['id'] == null) {
                    params = {};
                }
                Livewire.dispatch(event['nameMethod'], params);
            }
            function onNo() {

            }
            swalConfirm('Are you sure?', event['message'], onYes,onNo);
        });

        Livewire.on('swalAlert', (event) => {
            swalAlert(event[0]);
        });

        Livewire.on('swalBasic', (event) => {
            swalBasic(event[0]['message']);
        });
    });

</script>
