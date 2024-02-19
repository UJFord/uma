document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image-input');
    const imagePreviews = document.getElementById('image-previews');
    const currentCropImage = document.getElementById('current-crop-image'); // Assuming you have an element with this id

    // Existing code for removing current images
    const removeCurrentImages = () => {
        while (imagePreviews.firstChild) {
            imagePreviews.removeChild(imagePreviews.firstChild);
        }
    };

    // Add an event listener to the file input field
    imageInput.addEventListener('change', function (event) {
        // Remove current image previews
        removeCurrentImages();

        // Display the current crop image if it exists
        if (currentCropImage && currentCropImage.src) {
            const currentImageURL = currentCropImage.src;
            imagePreviews.appendChild(createImagePreview(currentImageURL, true));
        }

        // Display newly selected images
        const files = event.target.files;
        for (const file of files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imgURL = e.target.result;
                imagePreviews.appendChild(createImagePreview(imgURL));
            };

            reader.readAsDataURL(file);
        }
    });

    // Helper function to create image previews
    const createImagePreview = (imgURL, isCurrentImage = false) => {
        const img = new Image();
        img.src = imgURL;
        img.style.height = '200px'; // Optional styling
        img.classList.add('m-2', 'img-thumbnail'); // Optional styling

        // Add remove button for each image
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function () {
            URL.revokeObjectURL(img.src);
            imagePreviews.removeChild(img);
            imagePreviews.removeChild(removeButton);
        });

        imagePreviews.appendChild(img);
        imagePreviews.appendChild(removeButton);

        return img;
    };
});
