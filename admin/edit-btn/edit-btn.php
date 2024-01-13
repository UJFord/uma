<div id="button-div" class="fixed-bottom d-flex justify-content-end z-2">
    <!-- show in view mode -->
    <div id="edit-btn-box" class="m-3">
        <button id="edit-btn" type="button" class="btn btn-primary py-3 px-4 curator-only"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</button>
    </div>
    <!-- show in edit mode -->
    <div id="apply-cancel-box" class="d-none m-3">
        <!-- apply -->
        <!-- dapat mag reload sha sa page with all new and edited info -->
        <button id="apply-btn" type="submit" name="update" class="btn btn-success px-3 py-2 me-1"><i class="fa-solid fa-check me-1"></i>Apply</button>
        <!-- cancel -->
        <!-- dapat mag reload sha sa page nga ang state is just like tung gi click niya kani nga entry sa list -->
        <button id="cancel-btn" type="button" class="btn btn-secondary px-3 py-2"><i class="fa-solid fa-xmark me-1"></i>Cancel</button>
    </div>
</div>

<div id='delete-box' class="fixed-top d-flex justify-content-end d-none py-3 px-2 curator-only">
    <button id="delete-btn" type="submit" name="delete" class="btn btn-danger px-3 py-2">
        <i class="fa-solid fa-trash me-1"></i>Delete
    </button>
</div>

<script>
    // Function to validate input and submit the form
    function SubmitForm() {
        // If validation succeeds, submit the form
        submitForm();
    }

    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel');
        // Trigger the form submission
        if (form) {
            form.submit();
        }
    }
</script>