(function () {
	document.documentElement.classList.add("js");

	const onReady = function (callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	};

	onReady(function () {
		const header = document.querySelector(".site-header");
		const toggle = document.querySelector("[data-menu-toggle]");
		const panel = document.querySelector("[data-menu-panel]");
		const heroStack = document.querySelector(".hero-stack");
		const heroCards = document.querySelectorAll(".hero-stack__card");
		const themeSettings = window.flamebubblesTheme || {};
		const mobileBreakpoint = Number(themeSettings.mobileBreakpoint || 767);
		const reducedMotionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

		const closeMenu = function () {
			if (!toggle || !panel) {
				return;
			}

			toggle.setAttribute("aria-expanded", "false");
			panel.classList.remove("is-open");
			document.body.classList.remove("menu-open");
		};

		if (toggle && panel) {
			toggle.addEventListener("click", function () {
				const isExpanded = toggle.getAttribute("aria-expanded") === "true";
				toggle.setAttribute("aria-expanded", String(!isExpanded));
				panel.classList.toggle("is-open", !isExpanded);
				document.body.classList.toggle("menu-open", !isExpanded);
			});

			document.addEventListener("keydown", function (event) {
				if (event.key === "Escape") {
					closeMenu();
				}
			});

			window.addEventListener("resize", function () {
				if (window.innerWidth > mobileBreakpoint) {
					closeMenu();
				}
			});
		}

		const syncHeader = function () {
			if (!header) {
				return;
			}

			header.classList.toggle("is-scrolled", window.scrollY > 16);
		};

		syncHeader();
		window.addEventListener("scroll", syncHeader, { passive: true });

		const productTabs = document.querySelectorAll("[data-product-tabs]");

		productTabs.forEach(function (tabsRoot) {
			const tabButtons = tabsRoot.querySelectorAll("[role='tab']");
			const tabPanels = tabsRoot.querySelectorAll("[role='tabpanel']");

			if (!tabButtons.length || !tabPanels.length) {
				return;
			}

			const activateTab = function (nextTab) {
				const target = nextTab.getAttribute("data-tab-target");

				tabButtons.forEach(function (button) {
					const isActive = button === nextTab;
					button.classList.toggle("is-active", isActive);
					button.setAttribute("aria-selected", String(isActive));
					button.tabIndex = isActive ? 0 : -1;
				});

				tabPanels.forEach(function (panel) {
					const isActive = panel.getAttribute("data-tab-panel") === target;
					panel.classList.toggle("is-active", isActive);
					panel.hidden = !isActive;
				});
			};

			tabButtons.forEach(function (button, index) {
				button.addEventListener("click", function () {
					activateTab(button);
				});

				button.addEventListener("keydown", function (event) {
					if (event.key !== "ArrowRight" && event.key !== "ArrowLeft") {
						return;
					}

					event.preventDefault();

					const nextIndex =
						event.key === "ArrowRight"
							? (index + 1) % tabButtons.length
							: (index - 1 + tabButtons.length) % tabButtons.length;

					tabButtons[nextIndex].focus();
					activateTab(tabButtons[nextIndex]);
				});
			});
		});

		const quantityButtons = document.querySelectorAll(".quantity .quantity__button");

		quantityButtons.forEach(function (button) {
			button.addEventListener("click", function () {
				const quantity = button.closest(".quantity");
				const input = quantity ? quantity.querySelector(".qty") : null;

				if (!input) {
					return;
				}

				const stepAttr = input.getAttribute("step");
				const step = !stepAttr || stepAttr === "any" ? 1 : Number(stepAttr);
				const minAttr = input.getAttribute("min");
				const maxAttr = input.getAttribute("max");
				const min = minAttr ? Number(minAttr) : 0;
				const max = maxAttr ? Number(maxAttr) : Number.POSITIVE_INFINITY;
				const currentValue = Number(input.value || input.getAttribute("value") || min || 0);
				const direction = button.classList.contains("quantity__button--minus") ? -1 : 1;
				const nextValue = currentValue + step * direction;
				const safeValue = Math.min(max, Math.max(min, nextValue));

				if (!Number.isFinite(safeValue)) {
					return;
				}

				input.value = String(safeValue);
				input.dispatchEvent(new Event("change", { bubbles: true }));
			});
		});

		if (heroCards.length) {
			if (reducedMotionQuery.matches) {
				heroCards.forEach(function (card) {
					card.classList.add("is-loaded");
				});
			} else {
				window.requestAnimationFrame(function () {
					heroCards.forEach(function (card, index) {
						window.setTimeout(function () {
							card.classList.add("is-loaded");
						}, 140 + index * 120);
					});
				});
			}

			if (heroStack) {
				heroCards.forEach(function (card) {
					card.addEventListener("mouseenter", function () {
						heroStack.classList.add("has-card-hover");
					});

					card.addEventListener("mouseleave", function () {
						heroStack.classList.remove("has-card-hover");
					});
				});

				heroStack.addEventListener("mouseleave", function () {
					heroStack.classList.remove("has-card-hover");
				});
			}
		}
	});
})();
