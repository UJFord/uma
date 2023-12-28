// script for access levels in admin
// hide or show based on account type
document.addEventListener("DOMContentLoaded", function () {
    // Use PHP to set the user role dynamically
    var userRole = "<?php echo $_SESSION['role']; ?>";

    // Elements to show/hide based on user role
    var adminElements = document.querySelectorAll(".admin-only");
    var viewerElements = document.querySelectorAll(".viewer-only");

    // Function to set visibility based on user role
    function setVisibility(elements, isVisible) {
        elements.forEach(function (element) {
            element.style.display = isVisible ? "block" : "none";
        });
    }

    // Check user role and set visibility
    if (userRole === "admin") {
        setVisibility(adminElements, true);
        setVisibility(viewerElements, false);
    } else {
        setVisibility(adminElements, false);
        setVisibility(viewerElements, true);
    }
});
