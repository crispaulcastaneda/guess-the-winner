$(document).ready(function () {
  // Cache DOM elements
  const $modal = $(".modal");
  const $trigger = $(".trigger");
  const $closeButtons = $(".close-button");
  const $checkButton = $(".check-btn, .submit");
  const $step1 = $("#step1");
  const $step2 = $("#step2");
  const $previousBtn = $(".has--previous-btn");

  // Team navigation and UI controls
  $previousBtn.on("click", function () {
    $step2.addClass("hidden");
    $step1.removeClass("hidden");
  });

  function toggleModal() {
    $modal.toggleClass("show-modal");

    if ($modal.hasClass("show-modal")) {
      $("body").css("overflow", "hidden");
      $step1.removeClass("hidden");
      $step2.addClass("hidden");

      // Reset username input and error states when modal is shown
      $("#usernameInput").val("").css("border", "");
      $(".modal .predict--error-snackbar").removeClass("show");
      $("#clear-usernameInput").hide();
    } else {
      $("body").css("overflow", "");
    }
  }

  function windowOnClick(event) {
    if (event.target === $modal[0]) {
      toggleModal();
    }
  }

  // Team image mapping function
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

  // Helper function to get URL parameter
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    let regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    let results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  // Improved: Show snackbar with context awareness
  function showSnackbar(message, context) {
    // Determine which snackbar to show based on context
    let $snackbar;
    let $input;

    if (context === "modal") {
      $snackbar = $(".modal .predict--error-snackbar");
      $input = $("#usernameInput");
    } else if (context === "form") {
      $snackbar = $(".predict--submit-form .predict--error-snackbar");
      $input = $("#username");
    } else {
      // Default - use the closest snackbar
      $input = $("#usernameInput").is(":visible")
        ? $("#usernameInput")
        : $("#username");
      $snackbar = $input.closest("div").find(".predict--error-snackbar");
    }

    // Update and show the snackbar
    $snackbar.find("p").text(message);
    $snackbar.addClass("show");

    // Style the input field
    $input.css("border", "1px solid red");

    // Show the clear button for the relevant input
    if ($input.attr("id") === "usernameInput") {
      $("#clear-usernameInput").show();
    } else {
      $("#clear-username").show();
    }

    // Auto-hide after 5 seconds
    // setTimeout(() => {
    //   $snackbar.removeClass("show");
    // }, 5000);
  }

  // Check modal username
  function checkModalUsername() {
    const username = $("#usernameInput").val().trim();

    if (username === "") {
      showSnackbar("Please enter a username.", "modal");
      return;
    }

    const currentLanguage = getUrlParameter("lang") || "en";

    $.ajax({
      url: "fetch_prediction.php",
      method: "POST",
      data: { username: username, selected_lang: currentLanguage },
      dataType: "json",
      beforeSend: function () {
        //console.log("Sending modal username request...");
      },
      success: function (data) {
       // console.log("Received data:", data);

        if (data.status === "success") {
          // Success: green border, hide clear icon
          $("#usernameInput").css("border", "1px solid green");
          $("#clear-usernameInput").hide();

          // Update content
          $("#team1check").text(data.team1);
          $("#team2check").text(data.team2);
          $("#selectedTeam").text(data.selected_team);

          $(".team--selected1 img, .team--has-pick:nth-child(1) img").attr({
            src: getTeamImage(data.team1),
            alt: data.team1 + " logo",
          });

          $(".team--selected2 img, .team--has-pick:nth-child(2) img").attr({
            src: getTeamImage(data.team2),
            alt: data.team2 + " logo",
          });

          $(
            ".team--has-pick:last-child img, .team--has-pick:nth-child(3) img"
          ).attr({
            src: getTeamImage(data.selected_team),
            alt: data.selected_team + " logo",
          });

          $step1.addClass("hidden");
          $step2.removeClass("hidden");
        } else {
          // Username not found - modal specific error
          showSnackbar(
            data.message || "No prediction found for this username.",
            "modal"
          );

          // Disable modal check button
          $(".check-btn").prop("disabled", true).css({
            "background-color": "#D2C5AC",
            color: "#BDA475",
            cursor: "not-allowed",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
        console.error("Response:", xhr.responseText);
        showSnackbar(
          "An error occurred while fetching your prediction. Please try again.",
          "modal"
        );

        // Disable modal check button
        $(".check-btn").prop("disabled", true).css({
          "background-color": "#D2C5AC",
          color: "#BDA475",
          cursor: "not-allowed",
        });
      },
    });
  }

  // Check form username
  function checkFormUsername() {
    const username = $("#username").val().trim();

    if (username === "") {
      showSnackbar("Please enter a username.", "form");
      return;
    }

    const currentLanguage = getUrlParameter("lang") || "en";

    $.ajax({
      url: "fetch_prediction.php",
      method: "POST",
      data: { username: username, selected_lang: currentLanguage },
      dataType: "json",
      beforeSend: function () {
        console.log("Sending form username request...");
      },
      success: function (data) {
        console.log("Received data:", data);

        if (data.status === "success") {
          // Success: green border, hide clear icon
          $("#username").css("border", "1px solid green");
          $("#clear-username").hide();

          // Enable submit button
          $(".submit").prop("disabled", false).css({
            "background-color": "",
            color: "",
            cursor: "pointer",
          });

          // Form may proceed normally or you can handle it here
          // For example, you might want to auto-submit the form
        } else {
          // Username not found - form specific error
          showSnackbar(
            data.message || "No prediction found for this username.",
            "form"
          );

          // Disable form submit button
          $(".submit").prop("disabled", true).css({
            "background-color": "#D2C5AC",
            color: "#BDA475",
            cursor: "not-allowed",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
        console.error("Response:", xhr.responseText);
        showSnackbar(
          "An error occurred while fetching your prediction. Please try again.",
          "form"
        );

        // Disable form submit button
        $(".submit").prop("disabled", true).css({
          "background-color": "#D2C5AC",
          color: "#BDA475",
          cursor: "not-allowed",
        });
      },
    });
  }

  // Modal input handlers
  $("#usernameInput").on("input", function () {
    const value = $(this).val().trim();

    // Reset error state
    $(this).css("border", "");
    $(".modal .predict--error-snackbar").removeClass("show");

    // Show/hide clear button
    if (value !== "") {
      $("#clear-usernameInput").show();
    } else {
      $("#clear-usernameInput").hide();
    }

    // Enable/disable button
    $(".check-btn")
      .prop("disabled", value === "")
      .css({
        "background-color": value === "" ? "#D2C5AC" : "",
        color: value === "" ? "#BDA475" : "",
        cursor: value === "" ? "not-allowed" : "",
      });
  });

  // Form input handlers
  $("#username").on("input", function () {
    const value = $(this).val().trim();

    // Reset error state
    $(this).css("border", "");
    $(".predict--submit-form .predict--error-snackbar").removeClass("show");

    // Show/hide clear button
    if (value !== "") {
      $("#clear-username").show();
    } else {
      $("#clear-username").hide();
    }

    // Enable/disable button
    $(".submit")
      .prop("disabled", value === "")
      .css({
        "background-color": value === "" ? "#D2C5AC" : "",
        color: value === "" ? "#BDA475" : "",
        cursor: value === "" ? "not-allowed" : "",
      });
  });

  // Modal clear button handler
  $("#clear-usernameInput").on("click", function () {
    $("#usernameInput").val("").focus().css("border", "");
    $(".modal .predict--error-snackbar").removeClass("show");
    $(this).hide();

    // Disable modal check button
    $(".check-btn").prop("disabled", true).css({
      "background-color": "#D2C5AC",
      color: "#BDA475",
      cursor: "not-allowed",
    });
  });

  // Form clear button handler
  $("#clear-username").on("click", function () {
    $("#username").val("").focus().css("border", "");
    $(".predict--submit-form .predict--error-snackbar").removeClass("show");
    $(this).hide();

    // Disable form submit button
    $(".submit").prop("disabled", true).css({
      "background-color": "#D2C5AC",
      color: "#BDA475",
      cursor: "not-allowed",
    });
  });

  // Hook up modal events
  $trigger.on("click", toggleModal);
  $closeButtons.on("click", toggleModal);
  $(window).on("click", windowOnClick);

  // Button click handlers - use specific buttons and functions
  $(".check-btn").on("click", checkModalUsername);
  $(".submit").on("click", function (e) {
    // If you want to validate before form submission
    e.preventDefault();
    checkFormUsername();
  });

  // Enter key handlers - separate for each input
  $("#usernameInput").on("keypress", function (e) {
    if (e.which === 13 && $(this).val().trim() !== "") {
      checkModalUsername();
      e.preventDefault();
    }
  });

  $("#username").on("keypress", function (e) {
    if (e.which === 13 && $(this).val().trim() !== "") {
      checkFormUsername();
      e.preventDefault();
    }
  });

  // Initialize UI state
  const initialModalUsername = $("#usernameInput").val().trim();
  $(".check-btn")
    .prop("disabled", !initialModalUsername)
    .css({
      "background-color": !initialModalUsername ? "#D2C5AC" : "",
      color: !initialModalUsername ? "#BDA475" : "",
      cursor: !initialModalUsername ? "not-allowed" : "",
    });

  const initialFormUsername = $("#username").val().trim();
  $(".submit")
    .prop("disabled", !initialFormUsername)
    .css({
      "background-color": !initialFormUsername ? "#D2C5AC" : "",
      color: !initialFormUsername ? "#BDA475" : "",
      cursor: !initialFormUsername ? "not-allowed" : "",
    });

  // Initially hide clear buttons
  $("#clear-usernameInput, #clear-username").hide();
});
