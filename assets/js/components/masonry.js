import Masonry from 'masonry-layout/masonry'

let element = document.querySelector('.masonry');
if (element) {
	let masonry = new Masonry( element, {// options
		itemSelector: '.masonry > *',
	});
	masonry.imagesLoaded().progress( function() {
		masonry.masonry('layout');
	});
}
