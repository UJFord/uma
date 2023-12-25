const input = document.getElementById('image-input');
const preview = document.getElementById('image-previews');

input.addEventListener('change', (e) => {
    const files = e.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = (e) => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add( 'm-2', 'img-thumbnail'); // Optional styling
        img.style.height = ('200px')
        preview.appendChild(img); // Append the new image preview
        };

        reader.readAsDataURL(file);
    }
});
