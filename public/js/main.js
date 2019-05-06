/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  "use strict";

  var window_width = $(window).width(),
      window_height = window.innerHeight,
      header_height = $(".default-header").height(),
      header_height_static = $(".site-header.static").outerHeight(),
      fitscreen = window_height - header_height; // $(".fullscreen").css("height", window_height)
  // $(".fitscreen").css("height", fitscreen);
  //-------- Fixed Header Js ----------//

  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 80) {
      $(".header-area").addClass("header-fixed");
    } else {
      $(".header-area").removeClass("header-fixed");
    }
  }); //------- Active Nice Select --------//

  $("select").niceSelect();
  /*----------------------------------------------------*/

  /*  Magnific Pop up js (Home Video)
    /*----------------------------------------------------*/

  $("#play-video").magnificPopup({
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });
  $(".img-pop-up").magnificPopup({
    type: "image",
    gallery: {
      enabled: true
    }
  }); // -------   Owl Carousel -----//0

  function home_banner_slider() {
    if ($(".home-banner-owl").length) {
      $(".home-banner-owl").owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        nav: true,
        autoplay: 2500,
        smartSpeed: 1500,
        dots: true,
        responsiveClass: true,
        stagePadding: 140,
        navText: ["<img src='img/prev.png' alt='' />", "<img src='img/next.png' alt='' />"],
        responsive: {
          0: {
            margin: 0,
            stagePadding: 0
          },
          1299: {
            margin: 10,
            stagePadding: 140
          }
        }
      });
    }
  }

  home_banner_slider(); //------- Filter  js --------//
  // Select all links with hashes

  $('a[href*="#"]') // Remove links that don't actually link to anything
  .not('[href="#"]').not('[href="#0"]').click(function (event) {
    // On-page links
    if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]"); // Does a scroll target exist?

      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $("html, body").animate({
          scrollTop: target.offset().top - 60
        }, 1000, function () {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();

          if ($target.is(":focus")) {
            // Checking if the target was focused
            return false;
          } else {
            $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable

            $target.focus(); // Set focus again
          }
        });
      }
    }
  });
  var unavailableDates = [{
    start: "2015-08-31",
    end: "2015-09-05"
  }, {
    start: "2015-09-11",
    end: "2015-09-15"
  }, {
    start: "2015-09-15",
    end: "2015-09-23"
  }, {
    start: "2015-10-01",
    end: "2015-10-07"
  }]; // Google Map

  if (document.getElementById("contactMap")) {
    var init = function init() {
      // Basic options for a simple Google Map
      // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
      var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 11,
        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(40.67, -73.94),
        // New York
        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{
          featureType: "water",
          elementType: "geometry",
          stylers: [{
            color: "#e9e9e9"
          }, {
            lightness: 17
          }]
        }, {
          featureType: "landscape",
          elementType: "geometry",
          stylers: [{
            color: "#f5f5f5"
          }, {
            lightness: 20
          }]
        }, {
          featureType: "road.highway",
          elementType: "geometry.fill",
          stylers: [{
            color: "#ffffff"
          }, {
            lightness: 17
          }]
        }, {
          featureType: "road.highway",
          elementType: "geometry.stroke",
          stylers: [{
            color: "#ffffff"
          }, {
            lightness: 29
          }, {
            weight: 0.2
          }]
        }, {
          featureType: "road.arterial",
          elementType: "geometry",
          stylers: [{
            color: "#ffffff"
          }, {
            lightness: 18
          }]
        }, {
          featureType: "road.local",
          elementType: "geometry",
          stylers: [{
            color: "#ffffff"
          }, {
            lightness: 16
          }]
        }, {
          featureType: "poi",
          elementType: "geometry",
          stylers: [{
            color: "#f5f5f5"
          }, {
            lightness: 21
          }]
        }, {
          featureType: "poi.park",
          elementType: "geometry",
          stylers: [{
            color: "#dedede"
          }, {
            lightness: 21
          }]
        }, {
          elementType: "labels.text.stroke",
          stylers: [{
            visibility: "on"
          }, {
            color: "#ffffff"
          }, {
            lightness: 16
          }]
        }, {
          elementType: "labels.text.fill",
          stylers: [{
            saturation: 36
          }, {
            color: "#333333"
          }, {
            lightness: 40
          }]
        }, {
          elementType: "labels.icon",
          stylers: [{
            visibility: "off"
          }]
        }, {
          featureType: "transit",
          elementType: "geometry",
          stylers: [{
            color: "#f2f2f2"
          }, {
            lightness: 19
          }]
        }, {
          featureType: "administrative",
          elementType: "geometry.fill",
          stylers: [{
            color: "#fefefe"
          }, {
            lightness: 20
          }]
        }, {
          featureType: "administrative",
          elementType: "geometry.stroke",
          stylers: [{
            color: "#fefefe"
          }, {
            lightness: 17
          }, {
            weight: 1.2
          }]
        }]
      }; // Get the HTML DOM element that will contain your map
      // We are using a div with id="map" seen below in the <body>

      var mapElement = document.getElementById("contactMap"); // Create the Google Map using our element and options defined above

      var map = new google.maps.Map(mapElement, mapOptions); // Let's also add a marker while we're at it

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(40.67, -73.94),
        map: map,
        title: "Snazzy!"
      });
    };

    google.maps.event.addDomListener(window, "load", init);
  }

  $("#mc_embed_signup").find("form").ajaxChimp(); // -------   Mail Send ajax

  $(document).ready(function () {
    var form = $("#myForm"); // contact form

    var submit = $(".submit-btn"); // submit button

    var alert = $(".alert-msg"); // alert div for show alert message
    // form submit event

    form.on("submit", function (e) {
      e.preventDefault(); // prevent default form submit

      $.ajax({
        url: "mail.php",
        // form action url
        type: "POST",
        // form submit method get/post
        dataType: "html",
        // request type html/json/xml
        data: form.serialize(),
        // serialize form data
        beforeSend: function beforeSend() {
          alert.fadeOut();
          submit.html("Sending...."); // change submit button text
        },
        success: function success(data) {
          alert.html(data).fadeIn(); // fade in response data

          form.trigger("reset"); // reset form

          submit.attr("style", "display: none !important"); // reset submit button text
        },
        error: function error(e) {
          console.log(e);
        }
      });
    });
  });
});

/***/ }),

/***/ 13:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\oLivroDahora\resources\js\main.js */"./resources/js/main.js");


/***/ })

/******/ });