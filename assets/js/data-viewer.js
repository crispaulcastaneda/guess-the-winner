document.addEventListener("DOMContentLoaded", function () {
  var recordsPerPageSelect = document.getElementById("recordsPerPage");

  if (recordsPerPageSelect) {
    recordsPerPageSelect.addEventListener("change", function () {
      document.getElementById("perPageForm").submit();
    });
  }
});
