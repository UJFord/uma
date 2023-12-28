<div id="button-div" class="fixed-bottom d-flex justify-content-end">
    <!-- show in view mode -->
    <div id="edit-btn-box" class="m-3">
        <button id="edit-btn" type="button" class="btn btn-primary py-3 px-4 admin-only"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</button>
    </div>
    <!-- shoe in edit mode -->
    <div id="apply-cancel-box" class="d-none m-3">
        <!-- apply -->
        <!-- dapat mag reload sha sa page with all new and edited info -->
        <button id="apply-btn" type="submit" name="update" class="btn btn-success px-3 py-2 me-1" onclick="validateAndSubmitForm()"><i class="fa-solid fa-check me-1"></i>Apply</button>
        <!-- cancel -->
        <!-- dapat mag reload sha sa page nga ang state is just like tung gi click niya kani nga entry sa list -->
        <button id="cancel-btn" type="button" class="btn btn-secondary px-3 py-2"><i class="fa-solid fa-xmark me-1"></i>Cancel</button>
    </div>
</div>

<div id='delete-box' class="fixed-top d-flex justify-content-end d-none py-3 px-2">
    <button id="delete-btn" type="submit" name="delete" class="btn btn-danger px-3 py-2">
        <i class="fa-solid fa-trash me-1"></i>Delete
    </button>
</div>

<script>
    // Function to validate input and submit the form
    function validateAndSubmitForm() {
        // Validate the form
        if (validateForm()) {
            // If validation succeeds, submit the form
            submitForm();
        }
    }

    // Function to validate input
    function validateForm() {
        // Get the values from the form
        var cropName = document.forms["Form"]["crop_name"].value;
        var imageInput = document.forms["Form"]["current_image"].value;
        var category = document.forms["Form"]["category"].value;
        var localName = document.forms["Form"]["local_name"].value;
        var uplandOrLowland = document.forms["Form"].querySelector('input[name="upland_or_lowland"]:checked');
        var description = document.forms["Form"]["description"].value;

        // Check if the required fields are not empty
        if (cropName === "" || imageInput === "" || category === "" || localName === "" || uplandOrLowland === null || description === "") {
            alert("Please fill out all required fields.");
            return false; // Prevent form submission
        }
        // You can add more validation checks if needed
        return true; // Allow form submission
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