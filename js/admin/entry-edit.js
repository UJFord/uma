let editBtn = document.querySelector('#edit-btn');
let applyBtn = document.querySelector('#apply-btn');
let cancelBtn = document.querySelector('#cancel-btn');
let linkElement = document.querySelector('#other_info_link'); // Replace 'your-link-id' with the actual ID of your link
let userEditBtn = document.querySelector('#user-edit-btn');  // for users editing

// Function to remove hidden attribute from an element
function showElement(elementId) {
    let element = document.getElementById(elementId);
    if (element) {
        element.removeAttribute('hidden');
    }
}

// Function to disable link
function disableLink(link) {
    link.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the default behavior (e.g., navigating to another page)
        input.classList.remove('cursor: pointer');
    });
}

// Function to enable link
function enableLink(link) {
    link.removeEventListener('click', (event) => {
        event.preventDefault(); // Remove the prevention of default behavior
    });
}

// Function to remove readonly attribute from text input fields
function enableTextInputs(containerId) {
    let textInputs = document.querySelectorAll(`#${containerId} input[type="text"][readonly]`);
    textInputs.forEach(input => {
        input.removeAttribute('readonly');
    });
}

// edit
editBtn.addEventListener('click', () => {
    // form panel input disabled
    let inputDisabled = document.querySelectorAll('#form-panel input[disabled], #form-panel textarea[disabled], #form-panel select[disabled]');

    // Enable readonly text inputs
    enableTextInputs('form-panel');

    // Disable link
    disableLink(linkElement);

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
    showElement('image-input');
});

userEditBtn.addEventListener('click', () => {
    // form panel input disabled
    let inputDisabled = document.querySelectorAll('#form-panel input[disabled], #form-panel select[disabled]');
    // edit box
    let editBox = document.querySelector('#user-edit-btn-box');
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
});
// cancel
cancelBtn.addEventListener('click', () => {
    // Enable link
    enableLink(linkElement);

    // Reload the page
    location.reload();
});
