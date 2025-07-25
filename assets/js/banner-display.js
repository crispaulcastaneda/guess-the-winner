function applyVisibility(data) {
  // Hide all first
  $(
    ".content__form, .prediction__date-before, .content__finals, .prediction__date-after, .prediction--table-results"
  ).hide();

  // Then show based on server flags
  if (data.show_form) $(".content__form").show();
  if (data.show_date_before) $(".prediction__date-before").show();
  if (data.show_finals) $(".content__finals").show();
  if (data.show_date_after) $(".prediction__date-after").show();
  if (data.show_results) $(".prediction--table-results").show();
}

// Fetch from PHP
function fetchVisibility() {
  fetch("dates_api.php")
    .then((response) => response.json())
    .then((data) => {
      applyVisibility(data);
    })
    .catch((err) => console.error("Failed to fetch visibility:", err));
}

// Initial call
fetchVisibility();

// Optional: Auto-refresh every X minutes (not every 300ms; that's too frequent)
setInterval(fetchVisibility, 1 * 60 * 1000); // Every 5 minutes
