console.log(
  "%c Proudly Crafted with ZiOn.",
  "background: #222; color: #bada55"
);

/* ---------------------------------------------- /*
 * Preloader
 /* ---------------------------------------------- */
(function () {
  $(window).on("load", function () {
    $(".loader").fadeOut();
    $(".page-loader").delay(600).fadeOut("slow");
    if ($(".slider").length) {
      $(".slider").bxSlider({
        mode: "horizontal",
        adaptiveHeight: false,
        pager: true,
        preventDefaultSwipeY: false,
        easing: "ease-out",
        auto: true,
        infiniteLoop: true,
        speed: 800,
        pause: 4000,
        pagerCustom: ".bx-pager",
        controls: false,
      });
    } else {
      return;
    }
  });

  $(document).ready(function () {
    /* ---------------------------------------------- /*
         * WOW Animation When You Scroll
         /* ---------------------------------------------- */

    wow = new WOW({
      mobile: false,
    });
    wow.init();

    /* ---------------------------------------------- /*
         * Scroll top
         /* ---------------------------------------------- */

    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $(".scroll-up").fadeIn();
      } else {
        $(".scroll-up").fadeOut();
      }
    });

    $('a[href="#totop"]').click(function () {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });

    /* ---------------------------------------------- /*
         * Initialization General Scripts for all pages
         /* ---------------------------------------------- */

    var homeSection = $(".home-section"),
      navbar = $(".navbar-custom"),
      navHeight = navbar.height(),
      worksgrid = $("#works-grid"),
      gallerygrid = $("#gallery-grid"),
      width = Math.max($(window).width(), window.innerWidth),
      mobileTest = false;

    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
      mobileTest = true;
    }

    buildHomeSection(homeSection);
    navbarAnimation(navbar, homeSection, navHeight);
    navbarSubmenu(width);
    hoverDropdown(width, mobileTest);

    $(window).resize(function () {
      var width = Math.max($(window).width(), window.innerWidth);
      buildHomeSection(homeSection);
      hoverDropdown(width, mobileTest);
    });

    $(window).scroll(function () {
      effectsHomeSection(homeSection, this);
      navbarAnimation(navbar, homeSection, navHeight);
    });

    /* ---------------------------------------------- /*
         * Set sections backgrounds
         /* ---------------------------------------------- */

    var module = $(".home-section, .module, .module-small, .side-image");
    module.each(function (i) {
      if ($(this).attr("data-background")) {
        $(this).css(
          "background-image",
          "url(" + $(this).attr("data-background") + ")"
        );
      }
    });

    /* ---------------------------------------------- /*
         * Home section height
         /* ---------------------------------------------- */

    function buildHomeSection(homeSection) {
      if (homeSection.length > 0) {
        if (homeSection.hasClass("home-full-height")) {
          homeSection.height($(window).height());
        } else {
          homeSection.height($(window).height() * 0.85);
        }
      }
    }

    /* ---------------------------------------------- /*
         * Home section effects
         /* ---------------------------------------------- */

    function effectsHomeSection(homeSection, scrollTopp) {
      if (homeSection.length > 0) {
        var homeSHeight = homeSection.height();
        var topScroll = $(document).scrollTop();
        if (
          homeSection.hasClass("home-parallax") &&
          $(scrollTopp).scrollTop() <= homeSHeight
        ) {
          homeSection.css("top", topScroll * 0.55);
        }
        if (
          homeSection.hasClass("home-fade") &&
          $(scrollTopp).scrollTop() <= homeSHeight
        ) {
          var caption = $(".caption-content");
          caption.css("opacity", 1 - (topScroll / homeSection.height()) * 1);
        }
      }
    }

    /* ---------------------------------------------- /*
         * Intro slider setup
         /* ---------------------------------------------- */

    if ($(".hero-slider").length > 0) {
      $(".hero-slider").flexslider({
        animation: "fade",
        animationSpeed: 1000,
        animationLoop: true,
        prevText: "",
        nextText: "",
        before: function (slider) {
          $(".titan-caption")
            .fadeOut()
            .animate(
              { top: "-80px" },
              { queue: false, easing: "swing", duration: 700 }
            );
          slider.slides.eq(slider.currentSlide).delay(500);
          slider.slides.eq(slider.animatingTo).delay(500);
        },
        after: function (slider) {
          $(".titan-caption")
            .fadeIn()
            .animate(
              { top: "0" },
              { queue: false, easing: "swing", duration: 700 }
            );
        },
        useCSS: true,
      });
    }

    /* ---------------------------------------------- /*
         * Rotate
         /* ---------------------------------------------- */

    $(".rotate").textrotator({
      animation: "dissolve",
      separator: "|",
      speed: 3000,
    });

    /* ---------------------------------------------- /*
         * Transparent navbar animation
         /* ---------------------------------------------- */

    function navbarAnimation(navbar, homeSection, navHeight) {
      var topScroll = $(window).scrollTop();
      if (navbar.length > 0 && homeSection.length > 0) {
        if (topScroll >= navHeight) {
          navbar.removeClass("navbar-transparent");
        } else {
          navbar.addClass("navbar-transparent");
        }
      }
    }

    /* ---------------------------------------------- /*
         * Navbar submenu
         /* ---------------------------------------------- */

    function navbarSubmenu(width) {
      if (width > 767) {
        $(".navbar-custom .navbar-nav > li.dropdown").hover(function () {
          var MenuLeftOffset = $(".dropdown-menu", $(this)).offset().left;
          var Menu1LevelWidth = $(".dropdown-menu", $(this)).width();
          if (width - MenuLeftOffset < Menu1LevelWidth * 2) {
            $(this).children(".dropdown-menu").addClass("leftauto");
          } else {
            $(this).children(".dropdown-menu").removeClass("leftauto");
          }
          if ($(".dropdown", $(this)).length > 0) {
            var Menu2LevelWidth = $(".dropdown-menu", $(this)).width();
            if (width - MenuLeftOffset - Menu1LevelWidth < Menu2LevelWidth) {
              $(this).children(".dropdown-menu").addClass("left-side");
            } else {
              $(this).children(".dropdown-menu").removeClass("left-side");
            }
          }
        });
      }
    }

    /* ---------------------------------------------- /*
         * Navbar hover dropdown on desctop
         /* ---------------------------------------------- */

    function hoverDropdown(width, mobileTest) {
      if (width > 767 && mobileTest !== true) {
        $(
          ".navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown"
        ).removeClass("open");
        var delay = 0;
        var setTimeoutConst;
        $(
          ".navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown"
        ).hover(
          function () {
            var $this = $(this);
            setTimeoutConst = setTimeout(function () {
              $this.addClass("open");
              $this.find(".dropdown-toggle").addClass("disabled");
            }, delay);
          },
          function () {
            clearTimeout(setTimeoutConst);
            $(this).removeClass("open");
            $(this).find(".dropdown-toggle").removeClass("disabled");
          }
        );
      } else {
        $(
          ".navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown"
        ).unbind("mouseenter mouseleave");
        $(".navbar-custom [data-toggle=dropdown]")
          .not(".binded")
          .addClass("binded")
          .on("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass("open");
            $(this)
              .parent()
              .siblings()
              .find("[data-toggle=dropdown]")
              .parent()
              .removeClass("open");
            $(this).parent().toggleClass("open");
          });
      }
    }

    /* ---------------------------------------------- /*
         * Navbar collapse on click
         /* ---------------------------------------------- */

    $(document).on("click", ".navbar-collapse.in", function (e) {
      if (
        $(e.target).is("a") &&
        $(e.target).attr("class") != "dropdown-toggle"
      ) {
        $(this).collapse("hide");
      }
    });

    /* ---------------------------------------------- /*
         * Video popup, Gallery
         /* ---------------------------------------------- */

    $(".video-pop-up").magnificPopup({
      type: "iframe",
    });

    $(".gallery-item").magnificPopup({
      delegate: "a",
      type: "image",
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1],
      },
      image: {
        titleSrc: "title",
        tError: "The image could not be loaded.",
      },
    });

    /* ---------------------------------------------- /*
         * Portfolio
         /* ---------------------------------------------- */

    var worksgrid = $("#works-grid"),
      worksgrid_mode;

    if (worksgrid.hasClass("works-grid-masonry")) {
      worksgrid_mode = "masonry";
    } else {
      worksgrid_mode = "fitRows";
    }

    worksgrid.imagesLoaded(function () {
      worksgrid.isotope({
        layoutMode: worksgrid_mode,
        itemSelector: ".work-item",
      });
    });

    $("#filters a").click(function () {
      $("#filters .current").removeClass("current");
      $(this).addClass("current");
      var selector = $(this).attr("data-filter");

      worksgrid.isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: "linear",
          queue: false,
        },
      });

      return false;
    });

    /* ---------------------------------------------- /*
         * Portfolio
         /* ---------------------------------------------- */

    var gallerygrid = $("#gallery-grid"),
      gallerygrid_mode;

    if (gallerygrid.hasClass("works-grid-masonry")) {
      gallerygrid_mode = "masonry";
    } else {
      gallerygrid_mode = "fitRows";
    }

    gallerygrid.imagesLoaded(function () {
      gallerygrid.isotope({
        layoutMode: gallerygrid_mode,
        itemSelector: ".photography-item",
      });
    });

    $("#filters a").click(function () {
      $("#filters .current").removeClass("current");
      $(this).addClass("current");
      var selector = $(this).attr("data-filter");

      gallerygrid.isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: "linear",
          queue: false,
        },
      });

      return false;
    });

    /* ---------------------------------------------- /*
         * Testimonials
         /* ---------------------------------------------- */

    if ($(".testimonials-slider").length > 0) {
      $(".testimonials-slider").flexslider({
        animation: "slide",
        smoothHeight: true,
      });
    }

    /* ---------------------------------------------- /*
         * Post Slider
         /* ---------------------------------------------- */

    if ($(".post-images-slider").length > 0) {
      $(".post-images-slider").flexslider({
        animation: "slide",
        smoothHeight: true,
      });
    }

    /* ---------------------------------------------- /*
         * Progress bar animations
         /* ---------------------------------------------- */

    $(".progress-bar").each(function (i) {
      $(this).appear(function () {
        var percent = $(this).attr("aria-valuenow");
        $(this).animate({ width: percent + "%" });
        $(this).find("span").animate({ opacity: 1 }, 900);
        $(this)
          .find("span")
          .countTo({ from: 0, to: percent, speed: 900, refreshInterval: 30 });
      });
    });

    /* ---------------------------------------------- /*
         * Funfact Count-up
         /* ---------------------------------------------- */

    $(".count-item").each(function (i) {
      $(this).appear(function () {
        var number = $(this).find(".count-to").data("countto");
        $(this)
          .find(".count-to")
          .countTo({ from: 0, to: number, speed: 1200, refreshInterval: 30 });
      });
    });

    /* ---------------------------------------------- /*
         * Youtube video background
         /* ---------------------------------------------- */

    jQuery(function () {
      jQuery("#video-player").YTPlayer();
    });

    $("#video-play").click(function (event) {
      event.preventDefault();
      if ($(this).hasClass("fa-play")) {
        $("#video-player").YTPPlay();
      } else {
        $("#video-player").YTPPause();
      }
      $(this).toggleClass("fa-play fa-pause");
      return false;
    });

    $("#video-volume").click(function (event) {
      event.preventDefault();
      if ($(this).hasClass("fa-volume-off")) {
        $("#video-player").YTPUnmute();
      } else {
        $("#video-player").YTPMute();
      }
      $(this).toggleClass("fa-volume-off fa-volume-up");
      return false;
    });

    /* ---------------------------------------------- /*
         * Owl Carousel
         /* ---------------------------------------------- */

    $(".owl-carousel").each(function (i) {
      // Check items number
      if ($(this).data("items") > 0) {
        items = $(this).data("items");
      } else {
        items = 4;
      }

      // Check pagination true/false
      if (
        $(this).data("pagination") > 0 &&
        $(this).data("pagination") === true
      ) {
        pagination = true;
      } else {
        pagination = false;
      }

      // Check navigation true/false
      if (
        $(this).data("navigation") > 0 &&
        $(this).data("navigation") === true
      ) {
        navigation = true;
      } else {
        navigation = false;
      }

      // Build carousel
      $(this).owlCarousel({
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>',
        ],
        nav: navigation,
        dots: pagination,
        loop: true,
        dotsSpeed: 400,
        items: items,
        navSpeed: 300,
        autoplay: 2000,
      });
    });

    /* ---------------------------------------------- /*
         * Blog masonry
         /* ---------------------------------------------- */

    $(".post-masonry").imagesLoaded(function () {
      $(".post-masonry").masonry();
    });

    /* ---------------------------------------------- /*
         * Scroll Animation
         /* ---------------------------------------------- */

    $(".section-scroll").bind("click", function (e) {
      var anchor = $(this);
      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: $(anchor.attr("href")).offset().top - 50,
          },
          1000
        );
      e.preventDefault();
    });

    /*===============================================================
         Working Contact Form
         ================================================================*/

    $("#contactForm").submit(function (e) {
      e.preventDefault();
      var $ = jQuery;

      var postData = $(this).serializeArray(),
        formURL = $(this).attr("action"),
        $cfResponse = $("#contactFormResponse"),
        $cfsubmit = $("#cfsubmit"),
        cfsubmitText = $cfsubmit.text();

      $cfsubmit.text("Sending...");

      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function (data) {
          $cfResponse.html(data);
          $cfsubmit.text(cfsubmitText);
          $("#contactForm input[name=name]").val("");
          $("#contactForm input[name=email]").val("");
          $("#contactForm textarea[name=message]").val("");
        },
        error: function (data) {
          alert("Error occurd! Please try again");
        },
      });

      return false;
    });

    /*===============================================================
         Working Request A Call Form
         ================================================================*/

    $("#requestACall").submit(function (e) {
      e.preventDefault();
      var $ = jQuery;

      var postData = $(this).serializeArray(),
        formURL = $(this).attr("action"),
        $cfResponse = $("#requestFormResponse"),
        $cfsubmit = $("#racSubmit"),
        cfsubmitText = $cfsubmit.text();

      $cfsubmit.text("Sending...");

      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function (data) {
          $cfResponse.html(data);
          $cfsubmit.text(cfsubmitText);
          $("#requestACall input[name=name]").val("");
          $("#requestACall input[name=subject]").val("");
          $("#requestACall textarea[name=phone]").val("");
        },
        error: function (data) {
          alert("Error occurd! Please try again");
        },
      });

      return false;
    });

    /*===============================================================
         Working Reservation Form
         ================================================================*/

    $("#reservationForm").submit(function (e) {
      e.preventDefault();
      var $ = jQuery;

      var postData = $(this).serializeArray(),
        formURL = $(this).attr("action"),
        $cfResponse = $("#reservationFormResponse"),
        $cfsubmit = $("#rfsubmit"),
        cfsubmitText = $cfsubmit.text();

      $cfsubmit.text("Sending...");

      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function (data) {
          $cfResponse.html(data);
          $cfsubmit.text(cfsubmitText);
          $("#reservationForm input[name=date]").val("");
          $("#reservationForm input[name=time]").val("");
          $("#reservationForm textarea[name=people]").val("");
          $("#reservationForm textarea[name=email]").val("");
        },
        error: function (data) {
          alert("Error occurd! Please try again");
        },
      });

      return false;
    });

    /* ---------------------------------------------- /*
         * Subscribe form ajax
         /* ---------------------------------------------- */

    $("#subscription-form").submit(function (e) {
      e.preventDefault();
      var $form = $("#subscription-form");
      var submit = $("#subscription-form-submit");
      var ajaxResponse = $("#subscription-response");
      var email = $("input#semail").val();

      $.ajax({
        type: "POST",
        url: "assets/php/subscribe.php",
        dataType: "json",
        data: {
          email: email,
        },
        cache: false,
        beforeSend: function (result) {
          submit.empty();
          submit.append('<i class="fa fa-cog fa-spin"></i> Wait...');
        },
        success: function (result) {
          if (result.sendstatus == 1) {
            ajaxResponse.html(result.message);
            $form.fadeOut(500);
          } else {
            ajaxResponse.html(result.message);
          }
        },
      });
    });

    /* ---------------------------------------------- /*
         * Google Map
         /* ---------------------------------------------- */

    if ($("#map").length == 0 || typeof google == "undefined") return;

    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, "load", init);

    var mkr = new google.maps.LatLng(40.67, -74.2);
    var cntr = mobileTest ? mkr : new google.maps.LatLng(40.67, -73.94);

    function init() {
      // Basic options for a simple Google Map
      // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
      var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 11,
        scrollwheel: false,
        // The latitude and longitude to center the map (always required)
        center: cntr, // New York

        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [
          {
            featureType: "all",
            elementType: "geometry.fill",
            stylers: [
              {
                visibility: "on",
              },
              {
                saturation: "-11",
              },
            ],
          },
          {
            featureType: "administrative",
            elementType: "geometry.fill",
            stylers: [
              {
                saturation: "22",
              },
            ],
          },
          {
            featureType: "administrative",
            elementType: "geometry.stroke",
            stylers: [
              {
                saturation: "-58",
              },
              {
                color: "#cfcece",
              },
            ],
          },
          {
            featureType: "administrative",
            elementType: "labels.text",
            stylers: [
              {
                color: "#f8f8f8",
              },
            ],
          },
          {
            featureType: "administrative",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#999999",
              },
              {
                visibility: "on",
              },
            ],
          },
          {
            featureType: "administrative",
            elementType: "labels.text.stroke",
            stylers: [
              {
                visibility: "on",
              },
            ],
          },
          {
            featureType: "administrative.country",
            elementType: "geometry.fill",
            stylers: [
              {
                color: "#f9f9f9",
              },
              {
                visibility: "simplified",
              },
            ],
          },
          {
            featureType: "landscape",
            elementType: "all",
            stylers: [
              {
                color: "#f2f2f2",
              },
            ],
          },
          {
            featureType: "landscape",
            elementType: "geometry",
            stylers: [
              {
                saturation: "-19",
              },
              {
                lightness: "-2",
              },
              {
                visibility: "on",
              },
            ],
          },
          {
            featureType: "poi",
            elementType: "all",
            stylers: [
              {
                visibility: "off",
              },
            ],
          },
          {
            featureType: "road",
            elementType: "all",
            stylers: [
              {
                saturation: -100,
              },
              {
                lightness: 45,
              },
            ],
          },
          {
            featureType: "road.highway",
            elementType: "all",
            stylers: [
              {
                visibility: "simplified",
              },
            ],
          },
          {
            featureType: "road.arterial",
            elementType: "labels.icon",
            stylers: [
              {
                visibility: "off",
              },
            ],
          },
          {
            featureType: "transit",
            elementType: "all",
            stylers: [
              {
                visibility: "off",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "all",
            stylers: [
              {
                color: "#d8e1e5",
              },
              {
                visibility: "on",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "geometry.fill",
            stylers: [
              {
                color: "#dedede",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "labels.text",
            stylers: [
              {
                color: "#cbcbcb",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#9c9c9c",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "labels.text.stroke",
            stylers: [
              {
                visibility: "off",
              },
            ],
          },
        ],
      };

      // Get the HTML DOM element that will contain your map
      // We are using a div with id="map" seen below in the <body>
      var mapElement = document.getElementById("map");

      // Create the Google Map using our element and options defined above
      var map = new google.maps.Map(mapElement, mapOptions);

      // Let's also add a marker while we're at it
      var image = new google.maps.MarkerImage(
        "assets/images/map-icon.png",
        new google.maps.Size(59, 65),
        new google.maps.Point(0, 0),
        new google.maps.Point(24, 42)
      );

      var marker = new google.maps.Marker({
        position: mkr,
        icon: image,
        title: "Titan",
        infoWindow: {
          content:
            "<p><strong>Rival</strong><br/>121 Somewhere Ave, Suite 123<br/>P: (123) 456-7890<br/>Australia</p>",
        },
        map: map,
      });
    }
  });

  function scroller() {
    $(
      "#mainMenu a[href^=#],#TOPBTN a[href^=#],#meganav a[href^=#],.mapinner a[href^=#],#meganav2 a[href^=#],#Menu a[href^=#],#SPMENUFOOT a[href^=#]"
    ).click(function () {
      // スクロールの速度
      var speed = 600; // ミリ秒
      // アンカーの値取得
      var href = $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? "html" : href);
      // 移動先を数値で取得
      var position = target.offset().top - 30;
      //       position =  (target.get( 0 ).offsetTop)-30;

      // スムーススクロール
      $("body,html").animate({ scrollTop: position }, speed, "easeInOutQuad");
      return false;
    });

    $(document).on("click", "#TOPBTN", function () {
      $("body,html").animate(
        {
          scrollTop: 0,
        },
        500
      );
      return false;
    });

    $(document).on("click", "#logo", function () {
      window.location.href = "/";
      return false;
    });

    $("#SPMENU a[href^=#]").click(function () {
      // スクロールの速度
      var speed = 1000; // ミリ秒
      // アンカーの値取得
      var href = $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? "html" : href);
      // 移動先を数値で取得
      var position = target.offset().top - 48;

      $(".menu-trigger").toggleClass("active");
      $("#SPMENU").toggleClass("active");
      scrollStart($("html"));
      scFLAG = false;

      // スムーススクロール
      $("body,html").animate({ scrollTop: position }, speed, "easeInOutCirc");
      return false;
    });
  }
})(jQuery);



(function () {
  const container = document.getElementById("newsBanner");
  const content = document.getElementById("newsBannerContent");

  if (!container || !content) return;

  // 設定
  const gap =
    parseFloat(
      getComputedStyle(document.documentElement).getPropertyValue("--gap")
    ) || 48;
  const baseSpeed =
    parseFloat(
      getComputedStyle(document.documentElement).getPropertyValue(
        "--base-speed"
      )
    ) || 60; // px/s
  const minFontRatio =
    parseFloat(
      getComputedStyle(document.documentElement).getPropertyValue(
        "--min-font-ratio"
      )
    ) || 0.65;
  const maxFontRatio =
    parseFloat(
      getComputedStyle(document.documentElement).getPropertyValue(
        "--max-font-ratio"
      )
    ) || 0.95;

  // 複製用ラッパーを作って中身をコピー（元のcontentは非表示にしない）
  function setupLoop() {
    // reset any previous duplicated node
    const existing = container.querySelectorAll(
      ".news-banner-content.duplicated"
    );
    existing.forEach((n) => n.remove());

    // get widths
    const containerW = container.clientWidth;
    // ensure content is inline for measurement
    content.style.position = "static";
    content.style.visibility = "hidden";
    content.style.display = "inline-flex";
    content.style.transform = "none";

    // measure single content width including gap (browser gives bounding box)
    const contentRect = content.getBoundingClientRect();
    let contentW = contentRect.width;

    // restore visibility
    content.style.visibility = "";
    content.style.display = "";

    // if content is too small, duplicate until >= containerW * 2 for seamless looping
    let totalCopyW = contentW;
    const wrapper = document.createElement("div");
    wrapper.className = "news-banner-content duplicated";
    wrapper.setAttribute("aria-hidden", "true");

    // copy nodes until sum >= containerW * 2
    while (totalCopyW < containerW * 2) {
      // clone original children
      const clone = content.cloneNode(true);
      clone.style.display = "inline-flex";
      clone.style.position = "static";
      clone.style.visibility = "";
      // append cloned children into wrapper (flatten one level)
      Array.from(clone.children).forEach((ch) =>
        wrapper.appendChild(ch.cloneNode(true))
      );
      totalCopyW += contentW;
      // prevent infinite loop
      if (wrapper.childElementCount > 500) break;
    }

    // append duplicated wrapper
    container.appendChild(wrapper);

    // now final measurement of combined block width (original + duplicated)
    const firstRect = content.getBoundingClientRect();
    const dupRect = wrapper.getBoundingClientRect();
    const combinedWidth = firstRect.width + dupRect.width;

    // compute scroll distance: negative value in px
    const scrollDistance = `-${firstRect.width}px`;

    // compute duration: distance (px) / speed (px/s)
    // choose speed proportional to baseSpeed; slower -> smaller baseSpeed value
    const distancePx = firstRect.width;
    const duration = Math.max(8, distancePx / baseSpeed); // 最低8秒に制限（調整可）

    // apply CSS variables and animation
    // set CSS var for distance on container so that keyframes can use it
    container.style.setProperty("--scroll-distance", `-${distancePx}px`);
    container.style.setProperty("--scroll-duration", `${duration}s`);

    // apply animation to both content blocks
    const anim = `scroll-left ${duration}s linear infinite`;
    content.style.animation = anim;
    wrapper.style.animation = anim;

    // adjust font-size to fit container height
    adjustFontToHeight();
  }

  function adjustFontToHeight() {
    const bannerHeight = container.clientHeight;
    // use ratio so fonts don't exactly equal line-height; allow some padding
    const ratio = Math.max(minFontRatio, Math.min(maxFontRatio, 0.85));
    const fontSize = Math.floor(bannerHeight * ratio);
    // apply to all items
    const items = container.querySelectorAll(".font-alt");
    items.forEach((it) => {
      it.style.fontSize = fontSize + "px";
      it.style.lineHeight = bannerHeight + "px";
    });
  }

  // rebuild on resize
  let resizeTimer = null;
  function onResize() {
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      // remove previous animation styles to re-measure correctly
      const all = container.querySelectorAll(".news-banner-content");
      all.forEach((n) => {
        n.style.animation = "";
      });
      setupLoop();
    }, 120);
  }

  // initial setup
  window.addEventListener("load", setupLoop);
  window.addEventListener("resize", onResize);

  // If container height changes via CSS, use ResizeObserver to adjust font-size + rebuild
  if (window.ResizeObserver) {
    const ro = new ResizeObserver(() => {
      onResize();
    });
    ro.observe(container);
  }
})();
