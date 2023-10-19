import 'jquery'
import 'popper.js'
import 'bootstrap'
import './components/headroom'
import './components/masonry'
import 'magnific-popup'
import 'jquery-ui/dist/jquery-ui'
import 'lavalamp'
import 'owl.carousel'
import skrollr from 'skrollr'
import AOS from 'aos'
import 'jquery-selectric'
import SmoothScroll from 'smooth-scroll'
import Swiper from "swiper"
import Vivus from 'vivus'

global.$ = global.jQuery = $;

(function ($) {
	"use strict";

	let fn = {

		// Launch Functions
		Launch: function () {
			fn.AOS();
			fn.ImageView();
			fn.Typed();
			fn.Swiper();
			fn.Vivus();
			fn.Overlay();
			fn.OwlCarousel();
			fn.Apps();
		},

		ImageView: function() {
			$('.lightbox').magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				image: {
					verticalFit: true
				}
			});

			$('.gallery').each(function() { // the containers for all your galleries
				$(this).magnificPopup({
					delegate: '.photo > a', // the selector for gallery item
					type: 'image',
					mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
					gallery: {
						enabled:true
					}
				});
			});

			$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false
			});
		},

		Typed: function() {
			if( $('#typed').length ) {
				let typed = new Typed("#typed", {
					stringsElement: '#typed-strings',
					typeSpeed: 100,
					backSpeed: 50,
					backDelay: 2000,
					startDelay: 200,
					loop: true
				});
			}
		},


		AOS: function() {

		},


		// Swiper
		Swiper: function() {

			$('.swiper-container').each(function(index, element){
				let $this = $(this)

				$this.find(".swiper-pagination").addClass("swiper-pagination-" + index);
				$this.find(".swiper-button-next").addClass("swiper-button-next-" + index);
				$this.find(".swiper-button-prev").addClass("swiper-button-prev-" + index);

				let options = {
					parallax: true,
					speed: 1500,
					simulateTouch: false,
					effect: 'fade',

					//pagination
					pagination: {
						el: '.swiper-pagination-' + index,
						clickable: true
					},

					// navigation
					navigation: {
						nextEl: '.swiper-button-next-' + index,
						prevEl: '.swiper-button-prev-' + index,
					}

				};

				let slider = $(this);

				if ($(this).hasClass('swiper-container-carousel')) {
					options.spaceBetween = 10;
					options.effect = 'slide';
					options.simulateTouch = true;
					options.slideToClickedSlide = true;
				}

				new Swiper ( slider, options );
			});



			if ( $( ".gallery-container" ).length ) {
				let galleryTop = new Swiper('.gallery-container', {
					effect: 'fade',
					speed: 1500,
					simulateTouch: false
				});
				let galleryThumbs = new Swiper('.gallery-thumbs', {
					centeredSlides: true,
					slidesPerView: 6,
					speed: 1500,
					breakpoints: {
						1600: { slidesPerView: 5 },
						1200: { slidesPerView: 3 },
						768: { slidesPerView: 2 },
						576: { slidesPerView: 2 }
					},
					slideToClickedSlide: true
				});
				galleryTop.controller.control = galleryThumbs;
				galleryThumbs.controller.control = galleryTop;
			}

		},


		// SVG Animation
		Vivus: function() {
			let myCallback = function () {};

			let myElements = document.querySelectorAll(".svg-icon svg");

			for (let i = myElements.length - 1; i >= 0; i--) {
				new Vivus(myElements[i], {duration: 100, type: 'async' }, myCallback);
			}
		},


		// Overlay Menu
		Overlay: function() {
			$(document).ready(function(){
				$('.burger').click(function(){
					let a = $(this);

					a.toggleClass('clicked');
					$('body').toggleClass('overlay-active');
					$('.overlay-menu').toggleClass('opened');
					$('.wrapper').toggleClass('push');
				});
			});
		},


		// Owl Carousel
		OwlCarousel: function() {

			$('.owl-carousel').each(function() {
				let a = $(this),
					items = a.data('items') || [1,1,1],
					margin = a.data('margin'),
					loop = a.data('loop'),
					nav = a.data('nav'),
					dots = a.data('dots'),
					center = a.data('center'),
					autoplay = a.data('autoplay'),
					autoplaySpeed = a.data('autoplay-speed'),
					rtl = a.data('rtl'),
					autoheight = a.data('autoheight');

				let options = {
					nav: nav || false,
					loop: loop || false,
					dots: dots || false,
					center: center || false,
					autoplay: autoplay || false,
					autoHeight: autoheight || false,
					rtl: rtl || false,
					margin: margin || 0,
					autoplayTimeout: autoplaySpeed || 3000,
					autoplaySpeed: 400,
					autoplayHoverPause: true,
					responsive: {
						0: { items: items[2] || 1 },
						576: { items: items[1] || 1 },
						1200: { items: items[0] || 1}
					}
				};

				a.owlCarousel(options);
			});
		},

		// Apps
		Apps: function () {

			// Navbar Nested Dropdowns
			$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
				let a = $(this);

				if (!a.next().hasClass('show')) {
					a.parents('.dropdown-menu').first().find('.show').removeClass("show");
				}

				let $subMenu = a.next(".dropdown-menu");
				$subMenu.toggleClass('show');

				a.parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
					$('.dropdown-submenu .show').removeClass("show");
				});

				return false;
			});


			// Accordion
			$('.accordion').accordion();


			// Lavalamp
			$('.nav').lavalamp({
				setOnClick: true,
				enableHover: false,
				margins: false,
				autoUpdate: true,
				duration: 200
			});


			// Tooltips
			$('[data-toggle="tooltip"]').tooltip();


			skrollr.init({
				forceHeight: false,
				mobileCheck: function() {
					//hack - forces mobile version to be off
					return false;
				}
			});


			// Video Player
			$(function () {
				if ( $('#my-player').length ) {
					let player = videojs('my-player');
				}
			});



			// Select
			$(function() {
				$('select').selectric({
					disableOnMobile: false,
					nativeOnMobile: false
				});
			});


			// Radial
			$('.progress-circle').each(function(){
				let a = $(this),
					b = a.data('percent'),
					c = a.data('color');

				let options = {
					value: (b / 100),
					size: 600,
					thickness: 15,
					startAngle: -Math.PI / 2,
					lineCap: 'round',
					fill: {
						color: c
					},
				};

				a.circleProgress(options).on('circle-animation-progress', function(event, progress, stepValue) {
					a.find('strong').html(Math.round(100 * stepValue) + '<i>%</i>');
				});
			});

			// Smooth Scroll
			$(function () {
				let scroll = new SmoothScroll('[data-scroll]');
			});


			// Filtering
			$(function () {
				if ( $('.filtr-container').length ) {
					let filterizd = $('.filtr-container').filterizr({
						layout: 'sameWidth'
					});
				}
			});


			// Speaker Panel
			$(function () {
				let a = $(".expand");
				let b = $(".collapse");

				a.click( function () {
					let c = $(this);

					a.removeClass("expanded");
					c.toggleClass("expanded");
				});

				b.click( function () {
					a.removeClass("expanded");
				});

			});


			AOS.init({
				duration: 800,
				anchorPlacement: 'center-bottom'
			});
		}


	};

	$(document).ready(function () {
		fn.Launch();
	});

})(jQuery);
