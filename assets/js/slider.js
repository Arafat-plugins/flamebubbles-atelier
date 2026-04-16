(function () {
	const onReady = function (callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	};

	onReady(function () {
		const sliders = Array.from(document.querySelectorAll("[data-slider]"));
		if (!sliders.length) {
			return;
		}

		const themeSettings = window.flamebubblesTheme || {};
		const mobileBreakpoint = Number(themeSettings.mobileBreakpoint || 767);
		const isMobileViewport = function () {
			return window.innerWidth <= mobileBreakpoint;
		};

		const getGap = function (track) {
			const styles = window.getComputedStyle(track);
			const gap = parseFloat(styles.columnGap || styles.gap || "0");
			return Number.isFinite(gap) ? gap : 0;
		};

		const getStep = function (track) {
			const firstCard = track.children[0];
			if (!firstCard) {
				return track.clientWidth * 0.9;
			}

			return firstCard.getBoundingClientRect().width + getGap(track);
		};

		const updateButtons = function (slider, track) {
			const prev = slider.querySelector("[data-slider-prev]");
			const next = slider.querySelector("[data-slider-next]");
			const mobile = isMobileViewport();
			// data-slider-always: keep arrows visible on desktop too
			const always = slider.hasAttribute("data-slider-always");

			slider.classList.toggle("is-mobile", mobile);

			if (!prev || !next) {
				return;
			}

			const shouldShow = mobile || always;
			prev.hidden = !shouldShow;
			next.hidden = !shouldShow;

			if (!shouldShow) {
				prev.disabled = true;
				next.disabled = true;
				return;
			}

			prev.disabled = track.scrollLeft <= 4;
			next.disabled =
				track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
		};

		sliders.forEach(function (slider) {
			const track = slider.querySelector("[data-slider-track]");
			if (!track) {
				return;
			}

			const prev = slider.querySelector("[data-slider-prev]");
			const next = slider.querySelector("[data-slider-next]");
			let ticking = false;

			if (prev) {
				prev.addEventListener("click", function () {
					track.scrollBy({ left: -getStep(track), behavior: "smooth" });
				});
			}

			if (next) {
				next.addEventListener("click", function () {
					track.scrollBy({ left: getStep(track), behavior: "smooth" });
				});
			}

			track.addEventListener(
				"scroll",
				function () {
					if (ticking) {
						return;
					}

					ticking = true;
					window.requestAnimationFrame(function () {
						updateButtons(slider, track);
						ticking = false;
					});
				},
				{ passive: true }
			);

			updateButtons(slider, track);
		});

		window.addEventListener("resize", function () {
			sliders.forEach(function (slider) {
				const track = slider.querySelector("[data-slider-track]");
				if (!track) {
					return;
				}

				updateButtons(slider, track);
			});
		});
	});
})();
