var urlParams = new URLSearchParams(window.location.search);
// var urlParamLang = 'th';
var urlParamLang = urlParams.get("lang");
var langJson;

if (urlParamLang) {
  if (
    urlParamLang != "th" &&
    urlParamLang != "en" &&
    urlParamLang != "vn" &&
    urlParamLang != "inr" &&
    urlParamLang != "krw" &&
    urlParamLang != "cn" &&
    urlParamLang != "mycn" &&
    urlParamLang != "id" &&
    urlParamLang != "jpy"
  ) {
    urlParamLang = "en";
  }
  fetchLangJson(urlParamLang);
} else if (urlParamLang == null || urlParamLang == "") {
  fetchLangJson("en");
} else {
  $.get(
    "https://ipinfo.io",
    function (response) {
      var detectedCountry = response.country;
      switch (detectedCountry.toLowerCase()) {
        case "id":
          langJson = "id";
          break;
        case "inr":
          langJson = "inr";
          break;
        case "vn":
          langJson = "vn";
          break;
        case "th":
          langJson = "th";
          break;
        case "cn":
          langJson = "cn";
          break;
        case "mycn":
          langJson = "mycn";
          break;
        case "krw":
          langJson = "krw";
          break;
        case "jpy":
          langJson = "jpy";
          break;
        default:
          langJson = "en";
          break;
      }
      fetchLangJson(langJson);
    },
    "jsonp"
  );
}

function fetchLangJson(country) {
  $(".header__langs .sel-lang").prepend(
    '<img src="assets/images/flags/' + country + '.svg">'
  );
  $("body").attr("data-lang", country);
  $.ajax({
    url: "assets/js/langcontent/" + country + ".json",
    type: "GET",
    cache: false,
    dataType: "json",
    success: function (result) {
      Object.entries(result).map((obj) => {
        const key = obj[0];
        const value = obj[1];
        $('[data-cta="' + key + '"]').attr("href", value);
      });
    },
    error: function () {
      alert("No");
    },
  });
}

function toggleTnc() {
  $(".tnc__head").toggleClass("active");
  $(".to-top").toggleClass("active");
  $(".tnc__content").slideToggle();
}
$(".content__banner__tnc, .tnc__head").click(function () {
  toggleTnc();
  $([document.documentElement, document.body]).animate(
    {
      scrollTop: $(".tnc").offset().top,
    },
    500
  );
});
$(".to-top .btn").click(function () {
  toggleTnc();
  $([document.documentElement, document.body]).animate(
    {
      scrollTop: $("body").offset().top,
    },
    500
  );
});

// slider - swiper
setTimeout(function () {
  var sliderSports = new Swiper(".swiper--sports", {
    navigation: {
      nextEl: ".swiper-next",
      prevEl: ".swiper-prev",
    },
    slidesPerView: "auto",
    breakpoints: {
      320: {
        spaceBetween: 8,
      },
      960: {
        spaceBetween: 16,
      },
    },
  });
}, 1000);

$(window).on("scroll", function () {
  if (
    $(window).scrollTop() >=
    $(".content__tiles").offset().top +
      $(".content__tiles").outerHeight() -
      window.innerHeight
  ) {
    $(".content__teaser").fadeIn();
  } else {
    $(".content__teaser").fadeOut();
  }
});

// For the accordion
const faqs = document.querySelectorAll(".option-hover");
faqs.forEach((faq) => {
  faq.addEventListener("click", () => {
    faq.classList.toggle("roll-active");
  });
});
