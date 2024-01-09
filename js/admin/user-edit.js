let editBtn = document.querySelector('#edit-btn');
let applyBtn = document.querySelector('#apply-btn');
let cancelBtn = document.querySelector('#cancel-btn');
let userEditBtn = document.querySelector('#user-edit-btn');  // for users editing

// Function to remove hidden attribute from an element
function showElement(elementId) {
    let element = document.getElementById(elementId);
    if (element) {
        element.removeAttribute('hidden');
    }
}

userEditBtn.addEventListener('click', () => {
    // form panel input disabled
    let inputDisabled = document.querySelectorAll('#form-panel input[disabled], #form-panel select[disabled]');
    // edit box
    let editBox = document.querySelector('#user-edit-btn');
    // apply and cancel box
    let applyCancelBox = document.querySelector('#confirm-btn');
    // delete button
    let deleteBox = document.querySelector('#delete-btn');

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
