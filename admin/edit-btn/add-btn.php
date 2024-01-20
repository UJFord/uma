<div id="button-div" class="fixed-bottom d-flex justify-content-end z-2">
    <!-- show in view mode -->
    <div id="edit-btn-box" class="m-3">
        <button id="apply-btn" type="submit" name="save" class="btn btn-success px-3 py-2 me-1 admin-only curator-only" onclick="validateAndSubmitForm()"><i class="fa-solid fa-check me-1"></i>Add</button>
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
        var imageInput = document.forms["Form"]["crop_image"].value;
        var category = document.forms["Form"].querySelector('input[name="category"]:checked');
        var localName = document.forms["Form"]["crop_local_name"].value;
        var uplandOrLowland = document.forms["Form"].querySelector('input[name="upland_or_lowland"]:checked');

        // Check if the required fields are not empty
        if (cropName === "" || imageInput === "" || category === "" || localName === "" || uplandOrLowland === null) {
            alert("Please fill out all required fields.");
            return false; // Prevent form submission
        }
        // You can add more validation checks if needed
        return true; // Allow form submission
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // Reset the form
                    form.reset();
                    // Reload unseen notifications
                    load_unseen_notification();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>