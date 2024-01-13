document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image-input');
    const imagePreviews = document.getElementById('image-previews');

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

        // Display newly selected images
        const files = event.target.files;
        for (const file of files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;
                img.style.height = '200px'; // Optional styling
                img.classList.add('m-2', 'img-thumbnail'); // Optional styling
                imagePreviews.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });
});