<div id="button-div" class="fixed-bottom d-flex justify-content-end z-2">
        <!-- approve -->
        <button id="apply-btn" type="submit" name="approve" class="btn btn-success px-3 py-2 me-1"><i class="fa-solid fa-check me-1"></i>Approve</button>

        <!-- delete -->
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