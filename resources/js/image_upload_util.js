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
