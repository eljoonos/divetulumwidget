(function () {
	"use strict";

	function initDivetulumSlider() {
		const sliders = document.querySelectorAll(".divetulum-sidebar-slider");
		sliders.forEach(function (slider) {
			if (slider.dataset.initialized === "1") {
				return;
			}
			slider.dataset.initialized = "1";
		});
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", initDivetulumSlider);
	} else {
		initDivetulumSlider();
	}
})();
