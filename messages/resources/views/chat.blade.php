@extends('future::layouts.app')
@section('content')
    <div class="card">
        <div class="row g-0" style="min-height: 70vh">
            @livewire('future::messages.list-conversation', ['conversationId' => $conversationId])
            @livewire('future::messages.messages', ['conversationId' => $conversationId])
        </div>
    </div>
@endsection
@section('script')
    <script type="module" data-navigate-once
            src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>

    <script data-navigate-once>
        let pickerOld = document.querySelector('emoji-picker');
        let icon = document.querySelector('#icon');
        if (icon) {
            document.querySelector('#icon').addEventListener('click', function (event) {
                event.preventDefault();

                if (pickerOld.style.display === 'block') {
                    pickerOld.style.display = 'none';
                } else {
                    pickerOld.style.display = 'block';
                    pickerOld.addEventListener('emoji-picker:dismiss', function () {
                        pickerOld.style.display = 'none';
                    });
                }
            });
        }
    </script>
    <script data-navigate-once>
        function handleFiles(files) {
            let fileInput = document.getElementById('fileUpload');
            if (!fileInput) {
                return;
            }
            let dt = new DataTransfer();
            fileInput.files = dt.files;
            fileInput.files = files;
            dragging = false;
            var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
            if (files.length > 0) {
                uploadModal.show();
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let listItem = document.createElement('div');
                    listItem.className = 'list-group-item';
                    let row = document.createElement('div');
                    row.className = 'row align-items-center';
                    let colAuto1 = document.createElement('div');
                    colAuto1.className = 'col-auto';
                    let badge = document.createElement('span');
                    badge.className = 'badge bg-red';
                    colAuto1.appendChild(badge);
                    let colAuto2 = document.createElement('div');
                    colAuto2.className = 'col-auto';
                    let link = document.createElement('a');
                    link.href = '#';
                    let avatar = document.createElement('span');
                    avatar.className = 'avatar';
                    let fileType = file.name.split('.').pop().toLowerCase();
                    // Kiểm tra xem file có phải là ảnh hay không
                    if (file.type.startsWith('image/')) {
                        // Nếu file là ảnh, hiển thị URL của ảnh
                        let reader = new FileReader();
                        reader.onloadend = function () {
                            avatar.style.backgroundImage = 'url(' + reader.result + ')';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Nếu file không phải là ảnh, hiển thị ký tự đầu tiên của tên file
                        avatar.textContent = fileType[0];
                    }

                    link.appendChild(avatar);
                    colAuto2.appendChild(link);

                    let col = document.createElement('div');
                    col.className = 'col text-truncate';
                    let fileName = document.createElement('a');
                    fileName.className = 'text-reset d-block';
                    fileName.textContent = file.name;
                    let fileSize = document.createElement('div');
                    fileSize.className = 'd-block text-secondary text-truncate mt-n1';
                    fileSize.textContent = file.size + ' bytes';
                    col.appendChild(fileName);
                    col.appendChild(fileSize);

                    let colAuto3 = document.createElement('div');
                    colAuto3.className = 'col-auto';
                    let link2 = document.createElement('a');
                    link2.href = '#';
                    link2.className = 'list-group-item-actions';
                    link2.addEventListener('click', function (event) {
                        event.preventDefault();
                        listItem.remove();
                        let dt = new DataTransfer();
                        let fileInput = document.getElementById('fileUpload');
                        for (let j = 0; j < fileInput.files.length; j++) {
                            if (j !== i) {
                                dt.items.add(fileInput.files[j]);
                            }
                        }
                        fileInput.files = dt.files;
                    });
                    let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    svg.setAttribute('class', 'icon icon-tabler icon-tabler-x');
                    svg.setAttribute('width', '24');
                    svg.setAttribute('height', '24');
                    svg.setAttribute('viewBox', '0 0 24 24');
                    svg.setAttribute('stroke-width', '2');
                    svg.setAttribute('stroke', 'currentColor');
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke-linecap', 'round');
                    svg.setAttribute('stroke-linejoin', 'round');
                    let path1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    path1.setAttribute('stroke', 'none');
                    path1.setAttribute('d', 'M0 0h24v24H0z');
                    path1.setAttribute('fill', 'none');
                    let path2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    path2.setAttribute('d', 'M18 6l-12 12');
                    let path3 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    path3.setAttribute('d', 'M6 6l12 12');
                    svg.appendChild(path1);
                    svg.appendChild(path2);
                    svg.appendChild(path3);
                    link2.appendChild(svg);
                    colAuto3.appendChild(link2);

                    row.appendChild(colAuto1);
                    row.appendChild(colAuto2);
                    row.appendChild(col);
                    row.appendChild(colAuto3);
                    listItem.appendChild(row);

                    // Thêm list-group-item vào list-group
                    let listGroup = document.querySelector('#list-file');
                    listGroup.appendChild(listItem);
                }
            }
        }

        let overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.right = '0';
        overlay.style.bottom = '0';
        overlay.style.left = '0';
        overlay.style.background = 'rgba(0, 0, 0, 0.7)';
        overlay.style.display = 'flex';
        overlay.style.justifyContent = 'center';
        overlay.style.alignItems = 'center';
        overlay.style.color = 'white';
        overlay.style.fontSize = '2em';
        overlay.style.zIndex = '99999';
        overlay.textContent = 'Tải file lên';
        overlay.id = 'overlay';
        document.body.appendChild(overlay);

        // Ẩn overlay khi load trang
        overlay.style.display = 'none';

        // Lấy phần tử body
        let dropArea = document.body;
        let dragging = false;
        // Thêm sự kiện dragover để ngăn trình duyệt mặc định xử lý file
        dropArea.addEventListener('dragover', (event) => {
            event.stopPropagation();
            event.preventDefault();
            dragging = false;
            let fileInput = document.getElementById('fileUpload');
            if (!fileInput) {
                return;
            }
            // Thêm style khi kéo file vào
            event.dataTransfer.dropEffect = 'copy';
            // Hiển thị overlay
            overlay.style.display = 'flex';
            // Đặt dragging thành true
            dragging = true;
        });
        dropArea.addEventListener('dragend', (event) => {
            event.stopPropagation();
            event.preventDefault();
            let fileInput = document.getElementById('fileUpload');
            if (!fileInput) {
                return;
            }
            // Ẩn overlay nếu không kéo file
            if (!dragging) {
                overlay.style.display = 'none';
            }
            // Đặt dragging thành false
            dragging = false;
        });

        // Thêm sự kiện drop để xử lý file khi thả file vào
        dropArea.addEventListener('drop', (event) => {
            event.stopPropagation();
            event.preventDefault();
            let fileInput = document.getElementById('fileUpload');
            if (!fileInput) {
                return;
            }
            // Lấy file từ sự kiện
            let files = event.dataTransfer.files;
            // Xử lý file
            handleFiles(files);
            // Ẩn overlay nếu không kéo file
            if (!dragging) {
                overlay.style.display = 'none';
            }
            // Đặt dragging thành false
            dragging = false;
        });

        // Thêm sự kiện dragleave để ẩn overlay khi không kéo file nữa
        dropArea.addEventListener('dragleave', (event) => {
            event.stopPropagation();
            event.preventDefault();
            // Ẩn overlay nếu không kéo file
            if (!dragging) {
                overlay.style.display = 'none';
            }
            // Đặt dragging thành false
            dragging = false;
        });
    </script>
@endsection
