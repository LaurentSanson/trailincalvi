import Headroom from "headroom.js";

const element = document.querySelector("header");
const options = {
    tolerance: 0,
}

if (element) {
	const headroom = new Headroom(element, options);
	headroom.init();
}
