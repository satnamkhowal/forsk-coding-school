(function ($) {
	"use strict";

	/* ------------- GSAP Registration -------------*/

	gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin, SplitText);

	if ($("#smooth-wrapper").length && $("#smooth-content").length) {
		gsap.config({
			nullTargetWarn: false,
		});

		let smoother = ScrollSmoother.create({
			smooth: 1,
			effects: true,
			smoothTouch: 0.1,
			normalizeScroll: false,
			ignoreMobileResize: true,
		});
	}
	window.gsapController = function () {
		/* ------------- Match media Js -------------*/
		let mediaMatch = gsap.matchMedia();
		function rtlValue(value) {
			const isRTL = document.documentElement.dir === "rtl";
			return isRTL ? -value : value;
		}

		/* --------------------------------------------
			One page navigation
		-------------------------------------------- */
		function onePageNavAnimation() {
			document.addEventListener("click", function (e) {
				const btn = e.target.closest(
					".tj-scroll-btn, .has-onepage-nav .mainmenu ul:not(.sub-menu) > li > a, .has-onepage-nav .hamburger_menu .mobile_menu ul:not(.sub-menu) > li > a:not(.mean-expand)",
				);
				const tabBtn = e.target.closest(".tab-nav");
				if (!btn) return;
				e.preventDefault();
				let sectionTarget =
					btn.getAttribute("href") || btn.getAttribute("data-target");
				gsap.to(window, {
					duration: 0.3,
					scrollTo: { y: sectionTarget, offsetY: 0 },
				});

				// tab nav target
				let sectionTarget2 =
					tabBtn.getAttribute("href") || tabBtn.getAttribute("data-target");
				gsap.to(window, {
					duration: 0.3,
					scrollTo: { y: sectionTarget2, offsetY: 160 },
				});
			});
		}
		onePageNavAnimation();

		/* --------------------------------------------
			Title Animation
		-------------------------------------------- */
		/* tj-split-text-1 */
		function tjTitleAnimation() {
			if ($(".tj-split-text-1").length) {
				let staggerAmount = 0.1,
					delayValue = 0.1,
					easeType = "power1.inout",
					animatedTitleElements = document.querySelectorAll(".tj-split-text-1");

				animatedTitleElements.forEach(element => {
					const stagger = element.dataset.animationStagger || 0.45;
					const duration = element.dataset.animationDuration || 0.8;
					const delay = element.dataset.animationDelay || 0;
					const splitText = new SplitText(element, {
						type: "lines",
						linesClass: "line",
					});

					gsap.from(splitText.lines, {
						x: -20,
						filter: "blur(10px)",
						clipPath: "inset( 0 100% 0 0 )",
						duration: duration,
						ease: "power2.out",
						delay: delay,
						stagger: stagger,
						scrollTrigger: {
							trigger: element,
							start: "top 85%",
							end: "bottom 15%",
							toggleActions: "play none none none",
						},
					});
				});
			}

			// highlight text
			const highlightText = gsap.utils.toArray(".title-highlight");
			if (highlightText.length) {
				highlightText.forEach(el => {
					const split = new SplitText(el, {
						type: "lines",
						linesClass: "line",
					});

					const lines = split.lines;

					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: el,
							start: "top 80%",
							end: "top 20%",
							scrub: true,
						},
					});

					// ONE line at a time (no stagger overlap)
					lines.forEach(line => {
						tl.to(line, {
							"--highlight-offset": "100%",
							ease: "power2.out",
							duration: 1,
							stagger: 0.4,
						});
					});
				});
			}
		}
		tjTitleAnimation();

		/* --------------------------------------------
		 	Fade animation 
		-------------------------------------------- */
		function tjFadeAnimation() {
			if ($(".tj-fade-anim").length > 0) {
				gsap.utils.toArray(".tj-fade-anim").forEach(item => {
					let onscrollValue = item.getAttribute("data-on-scroll") || 1,
						fadeOffset = item.getAttribute("data-offset") || 50,
						delayValue = item.getAttribute("data-delay") || 0.15,
						durationValue = item.getAttribute("data-duration") || 1.15,
						fadeDirection = item.getAttribute("data-direction") || "bottom",
						easeValue = item.getAttribute("data-ease") || "power2.out",
						animationSetting = {
							opacity: 0,
							ease: easeValue,
							duration: durationValue,
							delay: delayValue,
							x: rtlValue(
								fadeDirection == "left"
									? -fadeOffset
									: fadeDirection == "right"
										? fadeOffset
										: 0,
							),
							y:
								fadeDirection == "top"
									? -fadeOffset
									: fadeDirection == "bottom"
										? fadeOffset
										: 0,
						};

					if (onscrollValue == 1) {
						animationSetting.scrollTrigger = {
							trigger: item,
							start: "top 100%",
						};
					}
					gsap.from(item, animationSetting);
				});
			}
		}
		tjFadeAnimation();

		/* --------------------------------------------
		 Zoom animation 
		-------------------------------------------- */
		function tjZoomAnimation() {
			if ($(".tj-zoom-anim").length > 0) {
				gsap.utils.toArray(".tj-zoom-anim").forEach(item => {
					let onscrollValue = item.getAttribute("data-on-scroll") || 1,
						delayValue = item.getAttribute("data-delay") || 0.15,
						durationValue = item.getAttribute("data-duration") || 1.15,
						zoomeValue = item.getAttribute("data-zoom-value") || "0",
						easeValue = item.getAttribute("data-ease") || "power2.out",
						animationSetting = {
							opacity: 0,
							ease: easeValue,
							duration: durationValue,
							delay: delayValue,
							scale: zoomeValue,
						};
					if (onscrollValue == 1) {
						animationSetting.scrollTrigger = {
							trigger: item,
							start: "top 90%",
						};
					}

					gsap.from(item, animationSetting);
				});
			}
		}
		tjZoomAnimation();

		/* --------------------------------------------
			Sidebar sticky
		-------------------------------------------- */
		function sidebarStickyController() {
			const containers = document.querySelectorAll(".tj-sticky-container");
			if (containers.length) {
				containers.forEach(container => {
					const panels = container.querySelectorAll(".tj-sticky-item");
					if (panels.length) {
						mediaMatch.add("(min-width: 992px)", () => {
							const startOffset = 90;
							const lastIdx = panels.length - 1;
							const lastPanel = panels[lastIdx];
							const paddingBottom =
								parseInt(getComputedStyle(container).paddingBottom, 10) || 0;
							panels.forEach((panel, i) => {
								gsap.to(panel, {
									scrollTrigger: {
										trigger: panel,
										start: `top-=${startOffset} top`,
										endTrigger: container,
										end: () =>
											`bottom top+=${
												lastPanel.offsetHeight + startOffset + paddingBottom
											}`,
										pin: true,
										pinSpacing: false,
										scrub: true,
										markers: false,
										invalidateOnRefresh: true,
									},
									ease: "circ",
								});
							});
						});
					}
				});
			}
		}
		sidebarStickyController();

		/* --------------------------------------------
			Sidebar sticky 2
		-------------------------------------------- */
		function sidebarStickyController2() {
			const containers = document.querySelectorAll(".tj-sticky-container-2");
			if (containers.length) {
				containers.forEach(container => {
					const panels = container.querySelectorAll(".tj-sticky-item-2");
					if (panels.length) {
						mediaMatch.add("(min-width: 300px)", () => {
							const startOffset = 90;
							const lastIdx = panels.length - 1;
							const lastPanel = panels[lastIdx];
							const paddingBottom =
								parseInt(getComputedStyle(container).paddingBottom, 10) || 0;
							panels.forEach((panel, i) => {
								gsap.to(panel, {
									scrollTrigger: {
										trigger: panel,
										start: `top-=${startOffset} top`,
										endTrigger: container,
										end: () =>
											`bottom top+=${
												lastPanel.offsetHeight + startOffset + paddingBottom
											}`,
										pin: true,
										pinSpacing: false,
										scrub: true,
										markers: false,
										invalidateOnRefresh: true,
									},
									ease: "circ",
								});
							});
						});
					}
				});
			}
		}
		sidebarStickyController2();

		/* --------------------------------------------
			Pin Animation
		-------------------------------------------- */
		function pinAnimationController() {
			const panels = document.querySelectorAll(".tj-pin-panel");
			if (panels.length) {
				panels.forEach(container => {
					mediaMatch.add("(min-width: 992px)", () => {
						const startOffset = 0;
						panels.forEach((panel, i) => {
							const panelInner = panel.querySelector(".tj-pin-panel-inner");
							const gtl = gsap.timeline({
								scrollTrigger: {
									trigger: panel,
									start: `top-=${startOffset} top`,
									end: "bottom top",
									pin: true,
									pinSpacing: false,
									scrub: true,
									markers: false,
									invalidateOnRefresh: true,
								},
							});
							gtl.set(panelInner, {
								pointerEvents: "all",
							});
							gtl.to(
								panelInner,
								{
									filter: `blur(14px)`,
									y: -100,
								},
								"0",
							);
							gtl.to(
								panelInner,
								{
									pointerEvents: "none",
								},
								".01",
							);
						});
					});
				});
			}
		}
		pinAnimationController();

		//  Skill  Progress Bar Js
		function progressBarController() {
			const progressContainers = document.querySelectorAll(".tj-progress");
			if (progressContainers?.length) {
				progressContainers.forEach(progressContainer => {
					const targetedProgressBar =
						progressContainer.querySelector(".tj-progress-bar");
					const completedPercent =
						parseInt(targetedProgressBar.getAttribute("data-percent"), 10) || 0;

					gsap.to(targetedProgressBar, {
						width: `${completedPercent}%`,
						ease: "power2.out",
						duration: 1,
						scrollTrigger: {
							trigger: progressContainer,
							start: "top 90%",
							end: "top 30%",
						},
						onUpdate: function () {
							let progressValue = Math.round(this.progress() * 100);
							let displayPercent = Math.round(
								(completedPercent * progressValue) / 100,
							);

							const percentageText = progressContainer.querySelector(
								".tj-progress-percent",
							);
							if (percentageText) {
								percentageText.textContent = displayPercent + "%";
							}
						},
					});
				});
			}
		}
		progressBarController();

		// Marquee Animation
		function tjMarquee() {
			const tjMarqueeWrappers = document.querySelectorAll(".tj-marquee");
			if (tjMarqueeWrappers?.length) {
				tjMarqueeWrappers?.forEach(wrapper => {
					const tjMarqueeItems = wrapper.querySelectorAll(".tj-marquee-item");
					const isIgnoreHover = wrapper.dataset.ignoreHover || false;
					const isReverse = wrapper.dataset.playReverse || false;
					const sign = isReverse ? -1 : 1;
					const fastSpeed = rtlValue(
						sign * (parseFloat(wrapper.dataset.scrollSpeed) || 3),
					);
					const slowSpeed = rtlValue(
						sign * (parseFloat(wrapper.dataset.scrollSpeedTargeted) || 1),
					);
					wrapper.style.direction = "ltr";
					const loop = horizontalLoop(tjMarqueeItems, {
						paused: false,
						repeat: -1,
					});

					// events
					gsap.to(loop, { timeScale: fastSpeed });
					if (!isIgnoreHover) {
						wrapper.addEventListener("mouseenter", () => {
							gsap.to(loop, { timeScale: slowSpeed, ease: "power1.in" });
						});
						wrapper.addEventListener("mouseleave", () => {
							gsap.to(loop, { timeScale: fastSpeed });
						});
					}

					function horizontalLoop(items, config) {
						items = gsap.utils.toArray(items);
						config = config || {};
						let tl = gsap.timeline({
								repeat: config.repeat,
								paused: config.paused,
								defaults: { ease: "none" },
								onReverseComplete: () =>
									tl.totalTime(tl.rawTime() + tl.duration() * 100),
							}),
							length = items.length,
							startX = items[0].offsetLeft,
							times = [],
							widths = [],
							xPercents = [],
							curIndex = 0,
							pixelsPerSecond = (config.speed || 1) * 100,
							snap =
								config.snap === false
									? v => v
									: gsap.utils.snap(config.snap || 1),
							totalWidth,
							curX,
							distanceToStart,
							distanceToLoop,
							item,
							i;
						gsap.set(items, {
							xPercent: (i, el) => {
								let w = (widths[i] = parseFloat(
									gsap.getProperty(el, "width", "px"),
								));
								xPercents[i] = snap(
									(parseFloat(gsap.getProperty(el, "x", "px")) / w) * 100 +
										gsap.getProperty(el, "xPercent"),
								);
								return xPercents[i];
							},
						});
						gsap.set(items, { x: 0 });
						totalWidth =
							items[length - 1].offsetLeft +
							(xPercents[length - 1] / 100) * widths[length - 1] -
							startX +
							items[length - 1].offsetWidth *
								gsap.getProperty(items[length - 1], "scaleX") +
							(parseFloat(config.paddingRight) || 0);
						for (i = 0; i < length; i++) {
							item = items[i];
							curX = (xPercents[i] / 100) * widths[i];
							distanceToStart = item.offsetLeft + curX - startX;
							distanceToLoop =
								distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
							tl.to(
								item,
								{
									xPercent: snap(((curX - distanceToLoop) / widths[i]) * 100),
									duration: distanceToLoop / pixelsPerSecond,
								},
								0,
							)
								.fromTo(
									item,
									{
										xPercent: snap(
											((curX - distanceToLoop + totalWidth) / widths[i]) * 100,
										),
									},
									{
										xPercent: xPercents[i],
										duration:
											(curX - distanceToLoop + totalWidth - curX) /
											pixelsPerSecond,
										immediateRender: false,
									},
									distanceToLoop / pixelsPerSecond,
								)
								.add("label" + i, distanceToStart / pixelsPerSecond);
							times[i] = distanceToStart / pixelsPerSecond;
						}
						function toIndex(index, vars) {
							vars = vars || {};
							Math.abs(index - curIndex) > length / 2 &&
								(index += index > curIndex ? -length : length);
							let newIndex = gsap.utils.wrap(0, length, index),
								time = times[newIndex];
							if (time > tl.time() !== index > curIndex) {
								vars.modifiers = { time: gsap.utils.wrap(0, tl.duration()) };
								time += tl.duration() * (index > curIndex ? 1 : -1);
							}
							curIndex = newIndex;
							vars.overwrite = true;
							return tl.tweenTo(time, vars);
						}
						tl.next = vars => toIndex(curIndex + 1, vars);
						tl.previous = vars => toIndex(curIndex - 1, vars);
						tl.current = () => curIndex;
						tl.toIndex = (index, vars) => toIndex(index, vars);
						tl.times = times;
						tl.progress(1, true).progress(0, true);
						if (config.reversed) {
							tl.vars.onReverseComplete();
							tl.reverse();
						}
						return tl;
					}
				});
			}
		}
		tjMarquee();

		// Counter Animation
		function counterAnimation() {
			const counters = document.querySelectorAll(".counter");
			if (!counters.length) return;

			counters.forEach(counter => {
				const start = parseFloat(counter.dataset.start ?? 0);
				const rawTarget = String(counter.dataset.target);
				const targetStr = rawTarget.replace(/,/g, "");
				const target = parseFloat(targetStr);
				const duration = parseFloat(counter.dataset.duration || 2);
				const delay = parseFloat(counter.dataset.delay || 0.4);
				const postfix = counter.dataset.postfix || "";

				// set initial value
				counter.innerText = start;

				const trigger = ScrollTrigger.create({
					trigger: counter,
					start: "top 85%",
					once: true,
					onEnter: () => {
						gsap.fromTo(
							counter,
							{ innerText: start },
							{
								innerText: target,
								duration,
								delay,
								ease: "power4.out",
								snap: { innerText: 0.1 },
								onUpdate: () => {
									let value = parseFloat(counter.innerText);

									// dynamic formatting
									let formattedValue;

									if (rawTarget.includes(",") || target >= 1000) {
										// comma formatting
										formattedValue = Math.round(value)
											.toString()
											.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
									} else if (/^0\d/.test(rawTarget)) {
										// leading zero
										formattedValue = Math.round(value)
											.toString()
											.padStart(2, "0");
									} else if (target % 1 !== 0) {
										// decimal point
										formattedValue = value.toFixed(1);
									} else if (target < 10) {
										// single digit
										formattedValue = Math.round(value).toString();
									} else {
										// default rounding
										formattedValue = Math.round(value).toString();
									}

									// append postfix dynamically
									if (formattedValue !== "NaN") {
										counter.innerText = formattedValue + postfix;
									}
								},
							},
						);
					},
				});
			});
		}
		counterAnimation();

		// Sticky Panel Animation
		function stickyPanelAnimation() {
			// Sticky Panel Animation
			const containers = document.querySelectorAll(
				".tj-sticky-panel-container",
			);
			if (containers.length) {
				containers.forEach(container => {
					mediaMatch.add("(min-width: 992px)", () => {
						let tl = gsap.timeline();
						let panels = container.querySelectorAll(".tj-sticky-panel");
						const startOffset = 110;

						const lastIdx = panels.length - 1;
						const lastPanel = panels[lastIdx];
						const paddingBottom =
							parseInt(getComputedStyle(container).paddingBottom) || 0;
						panels.forEach((panel, i) => {
							tl.to(panel, {
								scrollTrigger: {
									trigger: panel,
									pin: panel,
									scrub: 1,
									start: `top-=${i <= 1 ? startOffset : startOffset * i} top`,
									endTrigger: container,
									end: () =>
										`bottom top+=${
											lastPanel.offsetHeight +
											startOffset * lastIdx +
											paddingBottom
										}`,
									pinSpacing: false,
									markers: false,
									onRefresh(self) {
										self.pin.parentNode.classList.add("tj-sticky-panel-spacer");
									},
								},
							});
						});
					});
				});
			}
		}
		stickyPanelAnimation();

		// Sticky Panel 2 Animation
		function stickyPanelAnimation2() {
			const containers = document.querySelectorAll(
				".tj-sticky-panel-container-2",
			);

			if (!containers.length) return;

			containers.forEach(container => {
				mediaMatch.add("(min-width: 992px)", () => {
					const panels = container.querySelectorAll(".tj-sticky-panel-2");
					const startOffset = 95;

					const lastIdx = panels.length - 1;
					const lastPanel = panels[lastIdx];
					const paddingBottom =
						parseInt(getComputedStyle(container).paddingBottom) || 0;

					panels.forEach((panel, i) => {
						const inner = panel.querySelector(".tj-sticky-panel-2-inner");

						// PIN PANEL
						ScrollTrigger.create({
							trigger: panel,
							pin: panel,
							scrub: 1,
							start: `top-=${i < 1 ? startOffset : startOffset * (i + 1)} top`,
							endTrigger: container,
							end: () =>
								`bottom top+=${
									lastPanel.offsetHeight + startOffset * lastIdx + paddingBottom
								}`,
							pinSpacing: false,
							markers: false,

							onRefresh(self) {
								self.pin.parentNode.classList.add("tj-sticky-panel-spacer-2");
							},
						});

						// LAST ITEM NEVER FADES
						if (i === lastIdx) {
							gsap.set(inner, {
								opacity: 1,
								pointerEvents: "auto",
							});
							return;
						}

						// FADE ONLY DURING STICKY PERIOD
						gsap.fromTo(
							inner,
							{
								opacity: 1,
							},
							{
								opacity: 0.3,
								ease: "none",
								scrollTrigger: {
									trigger: panel,
									start: `top-=${
										i < 1 ? startOffset : startOffset * (i + 1)
									} top`,
									endTrigger: container,
									end: () => `+=300`,
									scrub: 2,
								},
							},
						);

						// DISABLE POINTER EVENTS WHEN FADED
						ScrollTrigger.create({
							trigger: panel,
							start: `top-=${i < 1 ? startOffset : startOffset * (i + 1)} top`,
							endTrigger: container,
							end: () =>
								`bottom top+=${
									lastPanel.offsetHeight + startOffset * lastIdx + paddingBottom
								}`,

							onLeave: () => {
								gsap.set(inner, {
									opacity: 0.3,
									pointerEvents: "none",
								});
							},

							onLeaveBack: () => {
								gsap.set(inner, {
									opacity: 1,
									pointerEvents: "auto",
								});
							},
						});
					});
				});
			});
		}
		stickyPanelAnimation2();

		// Course tab Animation
		function courseTabController() {
			const wrappers = document.querySelectorAll(".tj-tab-sticky-wrapper");

			if (!wrappers.length) return;

			mediaMatch.add("(min-width: 300px)", () => {
				wrappers.forEach(wrapper => {
					const tab = wrapper.querySelector(".tj-course-tab");
					if (!tab) return;

					const links = [...tab.querySelectorAll(".tab-nav")];

					links.forEach(link => {
						const target = document.querySelector(link.getAttribute("href"));
						if (!target) return;

						ScrollTrigger.create({
							trigger: target,
							start: "top 200",

							onEnter: () => {
								links.forEach(item => item.classList.remove("active"));
								link.classList.add("active");
							},

							onEnterBack: () => {
								links.forEach(item => item.classList.remove("active"));
								link.classList.add("active");
							},
						});
					});
				});
			});
		}
		courseTabController();
	};
})(jQuery);
