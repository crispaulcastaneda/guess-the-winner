$(document).ready(function () {
  function loadmoCSVkobeybe() {
    $.ajax({
      url: "./result-csv/id.csv",
      dataType: "text",
      success: function (data) {
        let rows = data
          .trim()
          .split("\n")
          .map((row) => row.split(","));
        let headers = rows[0].map((header) => header.trim());

        //  console.log("CSV Headers:", headers); // Debugging

        let usernameIndex = headers.indexOf("username");
        let currencyIndex = headers.indexOf("currency");
        let prizeIndex = headers.indexOf("prize");

        if (usernameIndex === -1 || currencyIndex === -1 || prizeIndex === -1) {
          console.error("Column indexes not found. Check CSV headers.");
          return;
        }

        let $leaderboardBody = $("#leaderboard-body");
        $leaderboardBody.empty(); // Clear old data

        let parsedData = rows.slice(1).map((row) => ({
          username: row[usernameIndex].trim(),
          currency: row[currencyIndex].trim().toLowerCase(), // Normalize currency to lowercase
          prize: parseFloat(row[prizeIndex].trim()), // Convert prize to number
        }));

        function getQueryParam(param) {
          return new URLSearchParams(window.location.search).get(param);
        }

        let userLang = getQueryParam("lang") || "en"; // Default to English

        let flagMap = {
          en: "./assets/images/flags/en.svg", // Malaysia Flag
          id: "./assets/images/flags/id.svg", // Indonesia Flag
        };

        let currencyMap = {
          en: "MYR",
          id: "IDR",
        };

        // Filter and sort data
        let filteredData = parsedData
          .filter((user) => user.currency === userLang) // Show only relevant data
          .sort((a, b) => b.prize - a.prize) // Sort in descending order by prize
          .slice(0, 10); // Limit to top 10

        filteredData.forEach((user) => {
          let flagURL = flagMap[userLang] || flagMap["en"];
          let maskedUsername = maskUsername(user.username);
          let currencySymbol = currencyMap[userLang] || "USD"; // Default to USD if undefined

          let $row = $("<tr>");
          let $usernameCell = $("<td>").addClass("username");

          $("<img>")
            .attr("src", flagURL)
            .attr("alt", user.currency)
            .attr("width", "20")
            .appendTo($usernameCell);

          $usernameCell.append(" " + maskedUsername);

          let $prizeCell = $("<td>").text(
            user.prize.toLocaleString() + " " + currencySymbol
          );

          $row.append($usernameCell).append($prizeCell);
          $leaderboardBody.append($row);
        });
      },
      error: function (error) {
        console.error("Error loading CSV:", error);
      },
    });
  }

  function maskUsername(username) {
    if (username.length <= 4) return username; // No masking for short usernames
    return (
      username[0] +
      "*".repeat(username.length - 3) +
      username[username.length - 1]
    );
  }

  loadmoCSVkobeybe();
});
