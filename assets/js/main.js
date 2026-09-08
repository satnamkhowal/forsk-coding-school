/***************************************************
==================== JS INDEX ======================
****************************************************
Preloader js
Data js
Back to Top Js
Topbar Remove Js
Sticky Nav Js
Mobile Menu Js
Search Bar Js
Nice Select Js
VenoBox Js
Copyright year JS
Tj Filter Js
Countdown js
Circle Progress Js
Testimonial Slider Js
Testimonial Slider 2 Js
Testimonial Slider 3 Js
Instructor Slider Js
Instructor Slider 2 Js
Course Slider Js
Categories Slider Js
Product Slider Js
Event Slider Js
Course list-grid view
Price Range Slider
Copy to clipboard Js
Course accordion
Quantity increase/decrease
Pricing switcher Js
Active bg Js
Privacy TOC JS

****************************************************/

(function ($) {
	"use strict";
	/* --------------------------------------------
		Preloader js
	-------------------------------------------- */
	$(window).on("load", function () {
		const tjPreloader = $(".preloader");
		if (tjPreloader?.length) {
			setTimeout(function () {
				tjPreloader.removeClass("is-loading").addClass("is-loaded");
				setTimeout(function () {
					tjPreloader.fadeOut(400);
					gsapController();
				});
			}, 0);
		} else {
			gsapController();
		}
	});
	/* --------------------------------------------
		Modify Number js
	-------------------------------------------- */
	window.modifyNumber = number => {
		const numberModifiabe = number ? number : 0;
		return numberModifiabe < 10 ? `0${numberModifiabe}` : numberModifiabe;
	};

	/* --------------------------------------------
		Data js
	-------------------------------------------- */
	$("[data-bg-image]").each(function () {
		var $this = $(this),
			$image = $this.data("bg-image");
		$this.css("background-image", "url(" + $image + ")");
	});
	$("[data-mask-image]").each(function () {
		var $this = $(this),
			$image = $this.data("mask-image");
		$this.css("mask-image", "url(" + $image + ")");
	});

	/* --------------------------------------------
		Back to Top Js
	-------------------------------------------- */
	function back_to_top() {
		var btn = $("#back-to-top");
		if (btn) {
			var btn_wrapper = $(".back-to-top-wrapper");

			$(window).on("scroll", function () {
				if ($(window).scrollTop() > 1200) {
					btn_wrapper.addClass("back-to-top-btn-show");
				} else {
					btn_wrapper.removeClass("back-to-top-btn-show");
				}
			});

			btn.on("click", function (e) {
				e.preventDefault();
				$("html, body").animate({ scrollTop: 0 }, "300");
			});
		}
	}
	back_to_top();

	/* --------------------------------------------
		Topbar Remove Js
	-------------------------------------------- */
	if ($(".topbar-close .close-btn").length > 0) {
		$("body").addClass("top-space");

		$(".topbar-close .close-btn").on("click", function () {
			$(this).parents(".header-top").remove();
			$("body").removeClass("top-space");
		});
	}

	/* --------------------------------------------
		Sticky Nav Js
	-------------------------------------------- */
	function stickyMenu($targetMenu, $toggleClass) {
		var st = $(window).scrollTop();

		// Default header sticky only for first 145px
		if (st < 145) {
			$(".header-fixed").addClass("sticky");
		} else {
			$(".header-fixed").removeClass("sticky");
		}

		// Duplicate sticky header after 640px
		if (st >= 500) {
			$targetMenu.addClass($toggleClass);
		} else {
			$targetMenu.removeClass($toggleClass);
		}
	}

	$(window).on("scroll", function () {
		if ($(".header-area").length) {
			stickyMenu($(".header-sticky"), "sticky");
		}
	});
	stickyMenu($(".header-sticky"), "sticky");

	/* --------------------------------------------
		Mobile Menu Js
	-------------------------------------------- */
	$(".mobile_menu_bar").on("click", function () {
		$(this).toggleClass("on");
	});

	// Mobile Menu Js
	$("#mobile-menu").meanmenu({
		meanMenuContainer: ".mobile_menu",
		meanScreenWidth: "991",
		meanExpand: ['<i class="tji-arrow-down"></i>'],
	});

	// Hamburger Menu Js
	$(".mobile_menu_bar").on("click", function () {
		$(".hamburger-area").addClass("opened");
		$(".body-overlay").addClass("opened");
		$("body").toggleClass("overflow-hidden");
	});

	$(".hamburger_close_btn").on("click", function () {
		$(".tj-offcanvas-area").removeClass("opened");
		$(".hamburger-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
		$("body").toggleClass("overflow-hidden");
	});
	$(".body-overlay").on("click", function () {
		$(".tj-offcanvas-area").removeClass("opened");
		$(".hamburger-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
		$("body").toggleClass("overflow-hidden");
	});

	/* --------------------------------------------
		Search Bar Js
	-------------------------------------------- */
	$(".header-search").on("click", function () {
		$(".search_popup").addClass("search-opened");
		$(".search-popup-overlay").addClass("opened");
	});
	$(".search_close_btn").on("click", function () {
		$(".search_popup").removeClass("search-opened");
		$(".search-popup-overlay").removeClass("opened");
	});
	$(".search-popup-overlay").on("click", function () {
		$(".search_popup").removeClass("search-opened");
		$(this).removeClass("opened");
	});

	/* --------------------------------------------
		Nice Select Js
	-------------------------------------------- */
	if ($(".tj-select select").length > 0) {
		$(".tj-select select").niceSelect();
	}

	/* --------------------------------------------
  VenoBox Js
	-------------------------------------------- */
	if ($(".tj-gallery").length > 0) {
		new VenoBox({
			selector: ".tj-gallery",
			numeration: true,
			// infinigall: true,
			spinner: "pulse",
		});
	}

	if ($(".video-popup").length > 0) {
		new VenoBox({
			selector: ".video-popup",
			numeration: true,
			// infinigall: true,
			spinner: "pulse",
		});
	}

	/*---------------------------------------------------------
	 Copyright year JS
	---------------------------------------------------------*/
	const yearEl = document.querySelector(".tj-copyright-text span");

	if (yearEl) {
		const currentYear = new Date().getFullYear();
		const spanYear = parseInt(yearEl.textContent, 10);

		if (spanYear < currentYear) {
			yearEl.textContent = currentYear;
		}
	}

	/*---------------------------------------------------------
  Tj Filter Js
	---------------------------------------------------------*/
	if ($(".tj_filter_item_wrapper")?.length) {
		$(".tj_filter_item_wrapper").imagesLoaded(function () {
			var $grid = $(".tj_filter_item_wrapper").isotope({
				itemSelector: ".tj_filter_item_wrapper .tj_filter_item",
				percentPosition: true,
				layoutMode: "fitRows",
			});

			// filter items on button click
			$(".tj_filter_btn_group").on("click", "button", function () {
				$(".tj_filter_btn_group button").removeClass("active");
				$(this).addClass("active");

				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});
		});
	}

	/*---------------------------------------------------------
	 Countdown js
	---------------------------------------------------------*/
	if ($(".countdown").length > 0) {
		$(".countdown").each(function () {
			const $wrap = $(this);

			const dateVal = $wrap.data("date");
			const targetTime = new Date(dateVal).getTime();

			// Prevent NaN countdown
			if (!dateVal || isNaN(targetTime)) {
				$wrap.find(".countdown-value").text("00");
				return;
			}

			const labels = {
				day: $wrap.data("day_label") || "Days",
				hour: $wrap.data("hour_label") || "Hours",
				min: $wrap.data("min_label") || "Mins",
				sec: $wrap.data("sec_label") || "Sec",
			};

			// Cache elements
			const el = {
				days: $wrap.find(".days .countdown-value"),
				hours: $wrap.find(".hours .countdown-value"),
				mins: $wrap.find(".minutes .countdown-value"),
				secs: $wrap.find(".seconds .countdown-value"),
				labelDays: $wrap.find(".days .countdown-heading"),
				labelHours: $wrap.find(".hours .countdown-heading"),
				labelMins: $wrap.find(".minutes .countdown-heading"),
				labelSecs: $wrap.find(".seconds .countdown-heading"),
			};

			const pad = n => String(n).padStart(2, "0");

			// Set labels
			el.labelDays.text(labels.day);
			el.labelHours.text(labels.hour);
			el.labelMins.text(labels.min);
			el.labelSecs.text(labels.sec);

			function tick() {
				const now = Date.now();
				const diff = targetTime - now;

				if (diff <= 0) {
					el.days.text("00");
					el.hours.text("00");
					el.mins.text("00");
					el.secs.text("00");
					clearInterval(timer);
					return;
				}

				const d = Math.floor(diff / 86400000);
				const h = Math.floor((diff / 3600000) % 24);
				const m = Math.floor((diff / 60000) % 60);
				const s = Math.floor((diff / 1000) % 60);

				el.days.text(pad(d));
				el.hours.text(pad(h));
				el.mins.text(pad(m));
				el.secs.text(pad(s));
			}

			tick();
			const timer = setInterval(tick, 1000);
		});
	}

	/* --------------------------------------------
  Circle Progress Js
	-------------------------------------------- */
	function circleProgress() {
		const circles = document.querySelectorAll(".circle-big");
		if (circles?.length) {
			// Intersection Observer to trigger when in viewport
			const observer = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							const circle = entry.target;
							const percent = parseInt(circle.getAttribute("data-percent", 10));
							const progress = circle.querySelector(".progress");
							const text = circle.querySelector("span");

							const circumference = 2 * Math.PI * 50;
							progress.style.strokeDasharray = circumference;
							progress.style.transition = "stroke-dashoffset 1.8s ease-out";

							const dashOffset =
								circumference - (percent / 100) * circumference;
							progress.style.strokeDashoffset = dashOffset;

							// Animate number counting
							let current = 0;
							const duration = 1500; // ms
							const stepTime = 15; // update interval
							const increment = percent / (duration / stepTime);

							const counter = setInterval(() => {
								current += increment;
								if (current >= percent) {
									current = percent;
									clearInterval(counter);
								}
								text.textContent = Math.floor(current) + "%";
							}, stepTime);

							observer.unobserve(circle); // Run only once
						}
					});
				},
				{ threshold: 0.5 },
			); // 50% visible

			circles.forEach(circle => {
				observer.observe(circle);
			});
		}
	}
	circleProgress();

	/* --------------------------------------------
		Testimonial Slider Js
	-------------------------------------------- */
	if ($(".tj-testimonial-slider").length > 0) {
		var testimonialSlider = new Swiper(".tj-testimonial-slider", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			pagination: {
				el: ".testimonial-pagination-1",
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 2.6,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3.2,
					spaceBetween: 30,
				},
				1550: {
					slidesPerView: 3.65,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Testimonial Slider 2 Js
	-------------------------------------------- */
	if ($(".tj-testimonial-slider-2").length > 0) {
		var testimonialSlider2 = new Swiper(".tj-testimonial-slider-2", {
			slidesPerView: 1.15,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			loopAdditionalSlides: 2,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			pagination: {
				el: ".testimonial-pagination-2",
				clickable: true,
			},
			breakpoints: {
				576: {
					slidesPerView: 1.25,
					spaceBetween: 20,
					centeredSlides: true,
				},
				1200: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Instructor Slider  Js
	-------------------------------------------- */
	if ($(".tj-instructor-slider").length > 0) {
		var testimonialSlider = new Swiper(".tj-instructor-slider", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-2",
				prevEl: ".slider-prev-2",
			},
			pagination: {
				el: ".instructor-pagination-1",
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Instructor Slider 2 Js
	-------------------------------------------- */
	if ($(".tj-instructor-slider-2").length > 0) {
		var testimonialSlider = new Swiper(".tj-instructor-slider-2", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			pagination: {
				el: ".instructor-pagination-1",
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Course Slider Js
	-------------------------------------------- */
	if ($(".tj-course-slider").length > 0) {
		var testimonialSlider = new Swiper(".tj-course-slider", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			pagination: {
				el: ".course-pagination-1",
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Categories Slider Js
	-------------------------------------------- */
	if ($(".tj-categories-slider").length > 0) {
		var categoriesSlider = new Swiper(".tj-categories-slider", {
			slidesPerView: 1,
			spaceBetween: 20,
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: ".slider-next-cat",
				prevEl: ".slider-prev-cat",
			},
			pagination: {
				el: ".categories-pagination",
				clickable: true,
			},
			breakpoints: {
				576: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				1200: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Product Slider Js
	-------------------------------------------- */
	if ($(".tj-product-slider").length > 0) {
		var testimonialSlider = new Swiper(".tj-product-slider", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Event Slider Js
	-------------------------------------------- */
	if ($(".tj-event-slider").length > 0) {
		var testimonialSlider = new Swiper(".tj-event-slider", {
			slidesPerView: 1,
			spaceBetween: 15,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1200: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
			},
		});
	}

	/* --------------------------------------------
		Flip Text Structure Js
	-------------------------------------------- */
	const flipTextItems = document.querySelectorAll(".flip-text-wrap .btn-text");
	if (flipTextItems?.length) {
		flipTextItems.forEach(el => {
			const text = el.textContent.trim();
			el.innerHTML = `
    <span class="btn-text-inner"><span>${text}</span><span>${text}</span></span>
  `;
		});
	}

	/* ---------------------------------------------------------
	 	Course list-grid view
   --------------------------------------------------------- */
	if ($(".tj-course-switch").length) {
		// list-view
		$(".tj-course-switch .list-view").on("click", function () {
			$(this).addClass("active").siblings().removeClass("active");
			$(".tj-course-wrapper").addClass("list-view-active");
		});

		// grid-view
		$(".tj-course-switch .grid-view").on("click", function () {
			$(this).addClass("active").siblings().removeClass("active");
			$(".tj-course-wrapper").removeClass("list-view-active");
		});
	}

	/* ---------------------------------------------------------
		Price Range Slider
	--------------------------------------------------------- */
	if ($("#slider-range").length) {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 135,
			values: [0, 85],
			slide: function (event, ui) {
				$("#price-from").text(ui.values[0]);
				$("#price-to").text(ui.values[1]);
			},
		});

		// Set initial values
		$("#price-from").text($("#slider-range").slider("values", 0));
		$("#price-to").text($("#slider-range").slider("values", 1));
	}

	/* ---------------------------------------------------------
  	Copy to clipboard Js
  --------------------------------------------------------- */
	document.querySelectorAll(".tj-copy").forEach(el => {
		const copyTooltip = el.querySelector(".copy-tooltip");
		const copyText = el.querySelector(".copy-text span");

		if (!copyTooltip || !copyText) return;

		el.onclick = e => {
			e.stopPropagation();

			navigator.clipboard.writeText(copyText.innerText.trim()).then(() => {
				copyTooltip.classList.add("show");
				setTimeout(() => copyTooltip.classList.remove("show"), 800);
			});
		};
	});

	// Share box js
	if ($(".share-wrap").length) {
		$(".share-wrap").hide();
		$(".share-popup").on("click", function (e) {
			e.stopPropagation();
			const $current = $(this).find(".share-wrap");
			$(".share-wrap").not($current).hide();
			$current.toggle();
		});

		$(".share-wrap").on("click", function (e) {
			e.stopPropagation();
		});
		$(document).on("click", function () {
			$(".share-wrap").hide();
		});
	}

	/* ---------------------------------------------------------
  	Course accordion
  --------------------------------------------------------- */
	$(".tj-course-accordion-content").hide();
	$(".tj-course-accordion-item:first-child .tj-course-accordion-header")
		.addClass("is-active")
		.next(".tj-course-accordion-content")
		.slideDown();
	$(".tj-course-accordion-header").on("click", function () {
		$(this)
			.toggleClass("is-active")
			.next(".tj-course-accordion-content")
			.stop(true, true)
			.slideToggle();
	});

	if ($(".tj-quick-product-details").length > 0) {
		const vb = new VenoBox({
			selector: ".tj-quick-product-details",
			numeration: true,
			spinner: "pulse",
			maxWidth: 800,
		});

		$(".tj-quick-product-details").on("click", function () {
			// Wait for VenoBox content to render
			setTimeout(function () {
				// Safely destroy existing swiper
				if (
					window.quickSwiper &&
					typeof window.quickSwiper.destroy === "function"
				) {
					window.quickSwiper.destroy(true, true);
				}

				// Re-initialize Swiper
				if ($(".tj-quick-details-slider").length > 0) {
					window.quickSwiper = new Swiper(".tj-quick-details-slider", {
						slidesPerView: 1,
						loop: true,
						speed: 1200,
						autoplay: {
							delay: 5000,
						},
						pagination: {
							el: ".swiper-pagination",
							clickable: true,
						},
						navigation: {
							nextEl: ".swiper-button-next",
							prevEl: ".swiper-button-prev",
						},
					});
					tjQuantityController();
				}
			}, 300);
		});
	}

	/* ---------------------------------------------------------
  	Quantity increase/decrease
  --------------------------------------------------------- */
	// increase quantity
	function tjQuantityController() {
		jQuery(".tj-cart-plus").on("click", function () {
			var original_p = jQuery(this).siblings(".tj-cart-input");
			var p_value = parseInt(original_p.val());
			if (p_value > 0) {
				p_value = p_value + 1;
			} else if (!p_value) {
				p_value = 1;
			}
			var formattedNumber = ("" + p_value).slice(-2);
			original_p.val(formattedNumber);
		});

		// decrease quantity
		jQuery(".tj-cart-minus").on("click", function () {
			var original_p = jQuery(this).siblings(".tj-cart-input");
			var p_value = parseInt(original_p.val());
			if (p_value > 1) {
				p_value = p_value - 1;
			} else if (!p_value) {
				p_value = 1;
			}
			var formattedNumber = ("" + p_value).slice(-2);
			original_p.val(formattedNumber);
		});
	}
	tjQuantityController();

	/* --------------------------------------------
		Testimonial Slider 3 Js
	-------------------------------------------- */
	if ($(".tj-testimonial-slider-3").length > 0) {
		var testimonialSlider3 = new Swiper(".tj-testimonial-slider-3", {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			speed: 1000,
			arrow: false,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".slider-next-1",
				prevEl: ".slider-prev-1",
			},
		});
	}

	/*---------------------------------------------------------
	 Pricing switcher Js
	---------------------------------------------------------*/
	if ($(".price-switcher").length) {
		$(".price-switcher").each(function () {
			let item = $(this);
			let year = item.find(".yearly");
			let month = item.find(".monthly");
			year.on("click", function () {
				$(this).addClass("active");
				month.removeClass("active");
			});
			month.on("click", function () {
				$(this).addClass("active");
				year.removeClass("active");
			});
			$(".pricing-item-lg").each(function () {
				let item = $(this);
				let price = item.find(".tj-price");
				year.on("click", function () {
					price.text(price.data("year-price"));
				});
				month.on("click", function () {
					price.text(price.data("month-price"));
				});
			});
		});
	}

	/*---------------------------------------------------------
	 Active bg Js
	---------------------------------------------------------*/
	function activeBgAnimation() {
		const containers = document.querySelectorAll(".tj-active-bg-container");
		if (!containers?.length) return;
		containers?.forEach(container => {
			const activeBg = container.querySelector(".tj-active-bg");
			let activeElement = container.querySelector(".active");

			function updateActiveBg(element) {
				if (!element) return;

				// Get element's position relative to container
				const rect = element.getBoundingClientRect();
				const containerRect = container.getBoundingClientRect();

				const left = rect.left - containerRect.left;
				const width = rect.width;
				const height = rect.height;

				// Remove 'active' class from siblings
				container
					.querySelectorAll(".tj-active-bg-item")
					.forEach(el => el.classList.remove("active"));
				element.classList.add("active");

				// Set active background style
				activeBg.style.left = `${left - 1}px`;
				activeBg.style.width = `${width}px`;
				activeBg.style.height = `${height}px`;
			}

			// Add click listeners
			container.querySelectorAll(".tj-active-bg-item").forEach(link => {
				link.addEventListener("click", () => updateActiveBg(link));
			});

			// Initialize active background
			updateActiveBg(activeElement);
		});
	}
	activeBgAnimation();

	/* --------------------------------------------
		Privacy TOC JS
	-------------------------------------------- */
	function privacyTocController() {
		const $toc = $(".tj-privacy-toc");
		if (!$toc.length) return;

		const $items = $toc.find(".toc-list li");

		function setActive($li) {
			if (!$li || !$li.length) return;
			$items.removeClass("active");
			$li.addClass("active");
		}

		$toc.find(".toc-list li a").on("click", function (e) {
			e.preventDefault();
			const target = document.querySelector($(this).attr("href"));
			setActive($(this).parent());
			if (!target) return;

			const smoother =
				window.ScrollSmoother && ScrollSmoother.get
					? ScrollSmoother.get()
					: null;
			if (smoother) {
				smoother.scrollTo(target, false, "top 120px");
			} else {
				const top =
					target.getBoundingClientRect().top + window.pageYOffset - 120;
				window.scrollTo({ top: top, behavior: "smooth" });
			}
		});

		// Scrollspy: highlight the section currently in view
		if (window.gsap && window.ScrollTrigger) {
			$(window).on("load", function () {
				setTimeout(function () {
					$toc.find(".toc-list li a").each(function () {
						const $li = $(this).parent();
						const target = document.querySelector($(this).attr("href"));
						if (!target) return;
						ScrollTrigger.create({
							trigger: target,
							start: "top 130px",
							end: "bottom 130px",
							onToggle: function (self) {
								if (self.isActive) setActive($li);
							},
						});
					});
					ScrollTrigger.refresh();
				}, 800);
			});
		}
	}
	privacyTocController();
})(jQuery);
