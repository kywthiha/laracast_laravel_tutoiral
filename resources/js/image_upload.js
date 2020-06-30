window.onload = function () {
    const image_upload_button = $("#image_upload");
    const upload_status = $("#upload_status");
    const image_input = $('input[type="hidden"]#article_image');
    const image_preview = $('img#image_preview');
    const choose_image_button = $('input[type="file"]#image');

    const ImageUploadRequest = ({url, image}) => {
        const formData = new FormData();
        formData.append('image', image);
        return fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body: formData
        })
    }

    const loadingUiStatus = () => {
        upload_status.html(`<span class="text-primary">Uploading....</span>`);
    }

    const uploadedUiStatus = ({path}) => {
        image_input.val(path);
        upload_status.html(`<span class="text-success">Upload Completed</span>`);
        image_preview.css({
            opacity: 1,
        });
    }
    const imageUploadChooseUiStatus = () => {
        image_input.attr('name', 'image');
        image_preview.css({
            opacity: 0.3,
        });
        upload_status.html(`<span class="text-danger">Please Upload Image</span>`);
    }

    const previewImage = ({preview, file}) => {
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            preview.src = reader.result;
            imageUploadChooseUiStatus();
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    const ImageUploadEvent = function (e) {
        e.preventDefault();
        const fileField = document.querySelector('input[type="file"]');
        ImageUploadRequest({
            url: $(this).attr('action'),
            image: fileField.files[0]
        })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
                if (result.status === 1) {
                    uploadedUiStatus({
                        path: result.path,
                    })
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        loadingUiStatus();
    }

    const previewImageEvent = function () {
        const preview = document.querySelector('img');
        const file = document.querySelector('input[type=file]').files[0];
        previewImage({
            preview,
            file
        })
    }

    image_upload_button.submit(ImageUploadEvent);
    choose_image_button.change(previewImageEvent);

}
