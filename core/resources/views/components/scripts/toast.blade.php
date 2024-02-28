<div class="toast position-absolute  end-0" style="z-index: 9999999;top: 60px" role="alert" aria-live="assertive"
     aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
    <div class="toast-header">
        <span class="avatar avatar-xs me-2">
            <i class="fa fa-info-circle"></i>
        </span>
        <strong class="me-auto">Mallory Hulme</strong>
        <small>11 mins ago</small>
        <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
             aria-valuemax="100"></div>
    </div>
</div>

<script>
    // Get the toast element
    // Get the toast element
    var toast = document.querySelector('.toast');
    var title = document.querySelector('.toast .me-auto');
    // Add a click event listener to the toast
    toast.addEventListener('click', function () {
        // Hide the toast when it is clicked
        hideToast();
    });

    // Check if the body has the 'dark' class
    if (document.body.dataset.bsTheme === 'dark') {
        // If yes, add the 'toast-dark' class to the toast
        toast.classList.add('bg-dark');
        title.classList.add('text-white');
    }

    // Make the toast draggable
    toast.draggable = true;

    // Define the dragstart event handler
    toast.addEventListener('dragstart', function (event) {
        // The dataTransfer.setData() method sets the data type and the value of the dragged data
        event.dataTransfer.setData('text/plain', getComputedStyle(event.target).cssText);
    });

    // Define the dragover event handler
    document.body.addEventListener('dragover', function (event) {
        // Prevent default to allow drop
        event.preventDefault();
    });

    // Define the drop event handler
    document.body.addEventListener('drop', function (event) {
        // Prevent default action (prevent file from being opened)
        event.preventDefault();

        // Move the toast to the new location
        toast.style.left = (event.clientX - toast.offsetWidth / 2) + 'px';
        toast.style.top = (event.clientY - toast.offsetHeight / 2) + 'px';
    });
</script>

<script>
    function showToast(title, time, message) {
        // Get the toast element
        var toast = document.querySelector('.toast');

        // Get the progress bar element
        var progressBar = toast.querySelector('.progress-bar');

        // Set the title, time, and message
        toast.querySelector('.me-auto').textContent = title;
        toast.querySelector('small').textContent = time;
        toast.querySelector('.toast-body').textContent = message;

        // Show the toast
        toast.classList.add('show');

        // Check if the body has the 'dark' class
        if (document.body.dataset.bsTheme === 'dark') {
            // If yes, add the 'toast-dark' class to the toast
            toast.classList.add('bg-dark');
        }

        // Reset the progress bar
        progressBar.style.width = '0%';
        progressBar.setAttribute('aria-valuenow', '0');

        // Start the progress bar
        var intervalId = setInterval(function () {
            var currentValue = parseInt(progressBar.getAttribute('aria-valuenow'));
            if (currentValue >= 100) {
                // Stop the progress bar
                clearInterval(intervalId);
                // Hide the toast
                toast.classList.remove('show');
            } else {
                // Increase the progress bar
                progressBar.style.width = (currentValue + 1) + '%';
                progressBar.setAttribute('aria-valuenow', currentValue + 1);
            }
        }, 30); // Adjust this value to change the speed of the progress bar
    }

    function hideToast() {
        // Get the toast element
        var toast = document.querySelector('.toast');

        // Hide the toast
        toast.classList.remove('show');
    }

    // hideToast();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
            .notification((notification) => {
                if (notification.type === 'App\\Notifications\\UserNotification') {
                    notification.time = new Date().toLocaleTimeString();
                    showToast(notification.title, notification.time, notification.content);
                }
            });
        // viết livewire để lắng nghe sự kiện
        window.Livewire.on('notification', (e) => {
            const {title, time, message} = e[0];
            showToast(title, time, message);
        });
    });
</script>
