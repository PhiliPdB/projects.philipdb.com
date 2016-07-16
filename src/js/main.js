window.onload = () => {	
	addEvent(window, "scroll", updateHeaderBackground);
	updateHeaderBackground();
}

function updateHeaderBackground(event) {
	const header = document.getElementById("header_background");
	const banner = document.getElementById("home");
	const scrollTop = window.scrollY;
	let offset = 0;
	let node = banner;
	while (node) {
		offset += node.offsetTop;
		node = node.offsetParent;
	}
	const height = banner.offsetHeight;

	offset += height;
	const calc = (scrollTop - offset + height) / height;

	header.style.opacity = calc;
	if (calc > 1) {
		header.style.opacity = 1;
	} else if (calc < 0) {
		header.style.opacity = 0;
	}
}

// This is a function from https://github.com/remy/html5demos
const addEvent = (() => {
	if (document.addEventListener) {
		return (el, type, fn) => {
			if (el && el.nodeName || el === window) {
				el.addEventListener(type, fn, false);
			} else if (el && el.length) {
				for (let i = 0; i < el.length; i++) {
					addEvent(el[i], type, fn);
				}
			}
		};
	} else {
		return (el, type, fn) => {
			if (el && el.nodeName || el === window) {
				el.attachEvent(`on${type}`, () => { return fn.call(el, window.event); });
			} else if (el && el.length) {
				for (let i = 0; i < el.length; i++) {
					addEvent(el[i], type, fn);
				}
			}
		};
	}
})();