window.onload = () => {
	// Set up everything...
	window.addEventListener("scroll", updateHeaderBackground);
	updateHeaderBackground();
}

function updateHeaderBackground() {
	const header = document.getElementById("header_background");
	const banner = document.getElementById("home");
	const scrollTop = window.scrollY;
	let offset = 0;

	// Calculate offset height of an element
	let node = banner;
	while (node) {
		offset += node.offsetTop;
		node = node.offsetParent;
	}
	
	const height = banner.offsetHeight;

	offset += height;
	const calc = (scrollTop - offset + height) / height;

	// Set header style
	header.style.opacity = calc;
	if (calc > 1) {
		header.style.opacity = 1;
	} else if (calc < 0) {
		header.style.opacity = 0;
	}
}
