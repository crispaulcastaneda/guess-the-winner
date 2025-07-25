/**
 * NBA TEAM COLLECTIONS
 */
const westernTeams = [
  "Lakers",
  "Warriors",
  "Nuggets",
  "Clippers",
  "Suns",
  "Mavericks",
  "Grizzlies",
  "Pelicans",
  "Timberwolves",
  "Kings",
  "Thunder",
  "Jazz",
  "Rockets",
  "Spurs",
  "Blazers",
];

const easternTeams = [
  "Celtics",
  "Bucks",
  "76ers",
  "Cavaliers",
  "Knicks",
  "Heat",
  "Nets",
  "Hawks",
  "Raptors",
  "Bulls",
  "Pacers",
  "Wizards",
  "Magic",
  "Hornets",
  "Pistons",
];

/**
 * NBA TEAM IMAGES
 */
function getTeamImage(teamName) {
  const teamImages = {
    Cavaliers: "./assets/images/prediction/team-ico/eastern/Cavaliers.png",
    Celtics: "./assets/images/prediction/team-ico/eastern/Celtics.png",
    Knicks: "./assets/images/prediction/team-ico/eastern/Knicks.png",
    Bucks: "./assets/images/prediction/team-ico/eastern/Bucks.png",
    Pacers: "./assets/images/prediction/team-ico/eastern/Pacers.png",
    Pistons: "./assets/images/prediction/team-ico/eastern/Pistons.png",
    Heat: "./assets/images/prediction/team-ico/eastern/Heat.png",
    Magic: "./assets/images/prediction/team-ico/eastern/Magic.png",
    Hawks: "./assets/images/prediction/team-ico/eastern/Hawks.png",
    Bulls: "./assets/images/prediction/team-ico/eastern/Bulls.png",
    Nets: "./assets/images/prediction/team-ico/eastern/Nets.png",
    "76ers": "./assets/images/prediction/team-ico/eastern/76ers.png",
    Raptors: "./assets/images/prediction/team-ico/eastern/Raptors.png",
    Hornets: "./assets/images/prediction/team-ico/eastern/Hornets.png",
    Wizards: "./assets/images/prediction/team-ico/eastern/Wizards.png",
    Thunder: "./assets/images/prediction/team-ico/western/Thunder.png",
    Lakers: "./assets/images/prediction/team-ico/western/Lakers.png",
    Nuggets: "./assets/images/prediction/team-ico/western/Nuggets.png",
    Grizzlies: "./assets/images/prediction/team-ico/western/Grizzles.png",
    Rockets: "./assets/images/prediction/team-ico/western/Rockets.png",
    Warriors: "./assets/images/prediction/team-ico/western/Warriors.png",
    Clippers: "./assets/images/prediction/team-ico/western/Clippers.png",
    Kings: "./assets/images/prediction/team-ico/western/Kings.png",
    Mavericks: "./assets/images/prediction/team-ico/western/Mavericks.png",
    Timberwolves:
      "./assets/images/prediction/team-ico/western/Timberwolves.png",
    Suns: "./assets/images/prediction/team-ico/western/Suns.png",
    "Trail Blazers":
      "./assets/images/prediction/team-ico/western/Trailblazers.png",
    Spurs: "./assets/images/prediction/team-ico/western/Spurs.png",
    Pelicans: "./assets/images/prediction/team-ico/western/Pelicans.png",
    Jazz: "./assets/images/prediction/team-ico/western/Jazz.png",
  };
  return (
    teamImages[teamName] ||
    "./assets/images/prediction/team-ico/western/Jazz.png"
  );
}

$(document).ready(function () {
  /**
   * NBA DROPDOWN FUNCTION
   */
  function setupDropdown(index, dropdown) {
    const $dropdown = $(dropdown);
    const $button = $dropdown.find(".dropdown-btn");
    const $list = $dropdown.find(".dropdown-list");
    const targetId = $dropdown.data("target");
    const $hiddenInput = $("#" + targetId);

    if (!$button.length || !$list.length || !$hiddenInput.length) {
      console.error("Dropdown setup failed: Missing Elements");
      return;
    }

    // Set default option
    const placeholderText = $button.data("placeholder") || "Select an option";
    $button.html(placeholderText).css("color", "#A7A9B0");

    // Button function
    $button.on("click", function (event) {
      event.stopPropagation();

      // Close all other dropdowns first
      $(".predict--custom-dropdown").not($dropdown).removeClass("active");
      $(".dropdown-list").not($list).removeClass("show");

      // Toggle the current dropdown
      $dropdown.toggleClass("active");
      $list.toggleClass("show");

      // default
      /**  closeAllDropdowns();
      $list.toggleClass("show");
      // new
      $dropdown.toggleClass("active");*/
    });

    // List function
    $list.on("click", ".dropdown-item", function () {
      const $item = $(this);
      const value = $item.data("value");
      const imageSrc = $item.data("img");

      const textColor = ["team1", "team2"].includes(targetId)
        ? "#222939"
        : "#222939";

      $button
        .html(
          `<span class="selected-image"><img src="${imageSrc}" alt="${value}"></span> ${value}`
        )
        .css("color", textColor);
      $hiddenInput.val(value);
      $list.removeClass("show");

      if (["team1", "team2"].includes(targetId)) {
        updateFinalistOptions();
        toggleInputs();
      }

      // new Close the dropdown and reset the arrow
      $list.removeClass("show");
      $dropdown.removeClass("active");
    });
  }

  /**
   * Close dropdowns when clicking outside
   */
  $(document).on("click", function (e) {
    if (!$(e.target).closest(".predict--custom-dropdown").length) {
      // default -> closeAllDropdowns();

      // new
      $(".predict--custom-dropdown").removeClass("active");
      $(".dropdown-list").removeClass("show");
    }
  });

  /**
   * Close all dropdowns
   */
  function closeAllDropdowns() {
    $(".dropdown-list").removeClass("show");
  }

  /**
   * Update finalist options
   */
  function updateFinalistOptions() {
    const team1 = $("#team1").val() || "";
    const team2 = $("#team2").val() || "";
    const $finalistList = $("#finalist-options");
    const $finalistButton = $("#finalist-dropdown .dropdown-btn");
    const $finalistInput = $("#selected_team");

    if (
      !$finalistList.length ||
      !$finalistButton.length ||
      !$finalistInput.length
    ) {
      console.error("Finalist dropdown elements are missing");
      return;
    }

    $finalistList.empty();

    if (team1 && team2) {
      $.each([team1, team2], function (index, team) {
        const imgSrc = getTeamImage(team);
        $finalistList.append(
          $("<li>")
            .addClass("dropdown-item")
            .attr("data-value", team)
            .attr("data-img", imgSrc)
            .html(`<img src="${imgSrc}" alt="${team}"> ${team}`)
        );
      });

      $finalistButton.html("Select Finalist");
      $finalistInput.val("");
    } else {
      $finalistList.append(
        $("<li>").addClass("placeholder").text("Select Team First")
      );
    }
  }

  /**
   * Toggle inputs
   */
  function toggleInputs() {
    const team1 = $("#team1").val() || "";
    const team2 = $("#team2").val() || "";
    const selectedTeam = $("#selected_team").val() || ""; // Add this line
    const $finalistDropdown = $("#finalist-dropdown");
    const $finalistButton = $("#finalist-dropdown .dropdown-btn");
    const $usernameInput = $("#username");
    const $submitButton = $(".predict--submit-form button");

    const disable = !(team1 && team2);
    const disableSubmit =
      disable || !$usernameInput.val().trim() || !selectedTeam; // Add selectedTeam check here

    if ($finalistDropdown.length) {
      $finalistDropdown.toggleClass("disabled", disable);
      $finalistButton.prop("disabled", disable);
    }

    if ($usernameInput.length) {
      // Set disabled attribute
      $usernameInput.prop("disabled", disable);

      // Toggle a class for additional styling
      if (disable) {
        $usernameInput.addClass("input-disabled");
      } else {
        $usernameInput.removeClass("input-disabled");
      }
    }

    if ($submitButton.length) {
      $submitButton.prop("disabled", disableSubmit).css({
        "background-color": disableSubmit ? "#D2C5AC" : "",
        color: disableSubmit ? "#BDA475" : "",
        cursor: disableSubmit ? "not-allowed" : "",
      });
    }
  }

  /**
   * Handle finalist selection
   */
  $("#finalist-options").on("click", ".dropdown-item", function () {
    const $item = $(this);
    const $finalistButton = $("#finalist-dropdown .dropdown-btn");
    const $finalistInput = $("#selected_team");
    const $lineOne = $(".bracket--line-one");
    const $lineTwo = $(".bracket--line-two");
    const value = $item.data("value");
    const imageSrc = $item.data("img");

    $finalistButton.html(
      `<span class="selected-image"><img src="${imageSrc}" alt="${value}"></span> ${value}`
    );
    $finalistInput.val(value);
    $("#finalist-options").removeClass("show");

    // Call toggleInputs to update the submit button state
    toggleInputs(); // Add this line

    // Remove and reapply animations
    $lineOne.css("animation", "none");
    $lineTwo.css("animation", "none");
    $lineOne[0].offsetWidth; // Force reflow
    $lineTwo[0].offsetWidth; // Force reflow

    // Set color based on conference
    let color = "";
    if ($.inArray(value, westernTeams) !== -1) {
      color = "#FFFFFF";
    } else if ($.inArray(value, easternTeams) !== -1) {
      color = "#FFFFFF";
    }

    if (color) {
      $finalistButton.css({
        "background-color": color,
        color: "#222939",
      });

      $lineOne.css("border-color", color);
      $lineTwo.css("border-color", color);

      // Reapply animations
      $lineOne.css("animation", "slideIn 0.5s ease-out forwards");
      $lineTwo.css("animation", "slideDown 0.5s ease-out forwards");
    }
  });

  /**
   * Username validation and form submission
   */
  if ($("#username").length && $(".predict--submit-form button").length) {
    // Create message span if it doesn't exist
    if (!$("#username-message").length) {
      $("<span>")
        .attr("id", "username-message")
        .css({
          display: "block",
          "font-size": "14px",
          "margin-top": "5px",
          color: "#C9334E",
          visibility: "hidden",
        })
        .appendTo($("#username").parent());
    }

    const $snackbar = $(".predict--error-snackbar");
    const $closeSnackbar = $snackbar.find(".close");

    // Username validation
    // Initially hide the clear icon
    $(".clear-input").hide();

    $("#username").on("input", function () {
      const username = $(this).val().trim();
      const $submitButton = $(".predict--submit-form button");

      if (username.length > 0) {
        $.ajax({
          url: "check_username.php",
          method: "POST",
          data: { username: username },
          success: function (data) {
            const exists = data.trim() === "exists";
            $submitButton.prop("disabled", exists).css({
              "background-color": exists ? "#D2C5AC" : "",
              color: exists ? "#BDA475" : "",
              cursor: exists ? "not-allowed" : "",
            });

            $("#username").css(
              "border",
              exists ? "1px solid red" : "1px solid green"
            );

            // Show the clear icon ONLY when the username exists/error occurs
            if (exists) {
              $snackbar.addClass("show");
              $(".clear-input").show();
            } else {
              $snackbar.removeClass("show");
              $(".clear-input").hide();
            }
          },
          error: function (error) {
            console.error("Error:", error);
          },
        });
      } else {
        $(this).css("border", "");
        $("#username-message").css("visibility", "hidden");
        toggleInputs();
        $snackbar.removeClass("show");
        $(".clear-input").hide();
      }
    });

    // Clear input when clicking the 'x' icon
    $(".clear-input").on("click", function () {
      $("#username").val("").trigger("input").focus();
      $(this).hide();
    });

    // Close snackbar
    $closeSnackbar.on("click", function () {
      $snackbar.removeClass("show");
    });

    // Form submission
    $("#predictionForm").on("submit", function (e) {
      e.preventDefault();

      $.ajax({
        url: "process.php",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
          console.log("Server Response:", data);

          if (data.status === "success") {
            $("#predictionForm")[0].reset();
            showModal(data.message, false);
          } else {
            showModal(data.message, true);
          }
        },
        error: function (error) {
          console.error("Fetch error:", error);
          showModal("Something went wrong. Please try again.", true);
        },
      });
    });
  }

  /**
   * Predict Modal functions
   */
  function showModal(message, isError = false) {
    const $modal = isError ? $(".modal--error") : $(".modal--success");
    const $overlay = $(".predict--modal-overlay"); // Select the overlay

    if (!$modal.length) return;

    // $modal.find(".predict--modal-body p").text(message);
    $modal.find(".predict--modal-body p").html(message);

    // Show the overlay and modal
    $overlay.css("display", "block");
    $modal.css("display", "block");

    // Ensure the modal closes when clicking the button or close icon
    $modal
      .find(".predict--modal-footer button, .predict--modal-header img")
      .off("click")
      .on("click", function () {
        $modal.css("display", "none");
        $overlay.css("display", "none"); // Hide the overlay as well
        location.reload();
      });
  }

  // function closeModal() {
  //   $(".predict--modal").css("display", "none");
  // }

  // $(".predict--modal-header img, .predict--modal-footer button").on(
  //   "click",
  //   closeModal
  // );

  // Initialize dropdowns
  $(".predict--custom-dropdown").each(setupDropdown);

  // Initialize inputs state
  toggleInputs();

  $("#selected_team").on("change", function () {
    toggleInputs();
  });
});
