<div id="button-div" class="fixed-bottom d-flex justify-content-end">
    <!-- show in view mode -->
    <div id="edit-btn-box" class="m-3">
        <button id="apply-btn" type="submit" name="save" class="btn btn-success px-3 py-2 me-1" onclick="submitForm()"><i class="fa-solid fa-check me-1"></i><Address>Add</Address></button>
    </div>
</div>

<script>
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
