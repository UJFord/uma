<script>
    function filterTable() {
        var input, filter, rows, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        rows = document.getElementsByClassName("filterable-row");

        for (i = 0; i < rows.length; i++) {
            var found = false;
            var cells = rows[i].getElementsByTagName("h4"); // Assuming the text to filter is inside an h4 element

            for (var j = 0; j < cells.length; j++) {
                txtValue = cells[j].textContent || cells[j].innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none";
        }
    }
</script>
