// Function to filter available courses by search keyword
function searchAvailableCourses() {
    var input = document.getElementById("searchAvailable");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("availableCoursesTable");
    var tr = table.getElementsByTagName("tr");

    // Loop through table rows, skipping the header row
    for (var i = 1; i < tr.length; i++) {
        var rowVisible = false;
        var td = tr[i].getElementsByTagName("td");
        // Check each cell in the row
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                var txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowVisible = true;
                    break;
                }
            }
        }
        tr[i].style.display = rowVisible ? "" : "none";
    }
}

// Function to fill search input with given courseId and filter courses
function fillSearch(courseId) {
    var input = document.getElementById("searchAvailable");
    input.value = courseId;
    searchAvailableCourses();
}
