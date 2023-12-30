<div id="button-div" class="fixed-bottom d-flex justify-content-end">
    <!-- show in view mode -->
    <div id="edit-btn-box" class="m-3">
        <button id="apply-btn" type="submit" name="save_crop" class="btn btn-success px-3 py-2 me-1 admin-only curator-only" onclick="validateAndSubmitForm()"><i class="fa-solid fa-check me-1"></i>Add</button>
    </div>
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
        var imageInput = document.forms["Form"]["image"].value;
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
