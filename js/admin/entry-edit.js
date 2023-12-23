let editBtn = document.querySelector('#edit-btn');
let applyBtn = document.querySelector('#apply-btn');
let cancelBtn = document.querySelector('#cancel-btn');

// Function to remove hidden attribute from an element
function showElement(elementId) {
    let element = document.getElementById(elementId);
    if (element) {
        element.removeAttribute('hidden');
    }
}

// edit
editBtn.addEventListener('click', () => {
    // form panel input disabled
    let inputDisabled = document.querySelectorAll('#form-panel input[disabled], #form-panel textarea[disabled], #form-panel select[disabled');

    // edit box
    let editBox = document.querySelector('#edit-btn-box');
    // apply and cancel box
    let applyCancelBox = document.querySelector('#apply-cancel-box');
    // delete button
    let deleteBox = document.querySelector('#delete-box');

    inputDisabled.forEach(input => {
        // enable form panel input
        input.removeAttribute('disabled');
        // add border
        input.classList.remove('border-0');
        input.classList.add('border');
    });

    // hide edit box
    editBox.classList.add('d-none');
    // show apply and cancel box
    applyCancelBox.classList.remove('d-none');
    // delete box
    deleteBox.classList.remove('d-none');

    // Example: Remove hidden attribute from an element with ID 'exampleElement'
    showElement('image');
});

// cancel
cancelBtn.addEventListener('click', () => {
    // Reload the page
    location.reload();
});
