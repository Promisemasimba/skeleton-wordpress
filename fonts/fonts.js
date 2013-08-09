WebFontConfig = {
	google: { families: [
		'Cabin:400,700,400italic,700italic:latin', 				// ss
		'Droid+Sans:400,700:latin',								// ss
		'Fjalla+One::latin',									// ss
		'Francois+One::latin', 									// ss
		'Istok+Web:400,700,400italic,700italic:latin',			// ss
		'Lato:400,700,400italic,700italic:latin', 				// ss
		'Maven+Pro:400,700:latin', 								// ss
		'Noto+Sans:400,700,400italic,700italic:latin', 			// ss
		'Open+Sans:400italic,700italic,400,700:latin', 			// ss
		'Oxygen:400,700:latin',									// ss
		'PT+Sans+Caption:400,700:latin', 						// ss
		'PT+Sans:400,700,400italic,700italic:latin', 			// ss
		'Raleway:400,700:latin', 								// ss
		'Roboto:400,400italic,700italic,700:latin',				// ss
		'Source+Sans+Pro:400,700,400italic,700italic:latin', 	// ss
		'Ubuntu:400,700,400italic,700italic:latin',				// ss
		'Bitter:400,700,400italic:latin',						// s
		'Cantata+One::latin', 									// s
		'Cardo:400,400italic,700:latin', 						// s
		'Crimson+Text:400,400italic,700,700italic:latin', 		// s
		'Droid+Serif:400,700,400italic,700italic:latin', 		// s
		'EB+Garamond::latin', 									// s
		'Gentium+Book+Basic:400,400italic,700,700italic:latin',	// s
		'Goudy+Bookletter+1911::latin',							// s
		'Lora:400,700,400italic,700italic:latin', 				// s
		'Merriweather:400,400italic,700,700italic:latin', 		// s
		'Noto+Serif:400,700,400italic,700italic:latin',			// s
		'PT+Serif+Caption:400,400italic:latin',					// s
		'PT+Serif:400,700,400italic,700italic:latin', 			// s
		'Playfair+Display:400,700,400italic,700italic:latin', 	// s
		'Quattrocento:400,700:latin', 							// s
		'Tinos:400,700,400italic,700italic:latin' 				// s
	] }
};
(function() {
	var wf = document.createElement('script');
	wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		':								//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	wf.type = 'text/javascript';
	wf.async = 'true';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);
})();

/*
 * STANDARD FONTS THAT ARE SUPPORTED BY MOST, IF NOT ALL SYSTEMS
 * Arial, Helvetica
 * Arial Black, Gadget
 * Georgia
 * Lucida Sans Unicode, Lucida Grande
 * Palatino Linotype, Palatino
 * Tahoma, Geneva
 * Times New Roman, Times
 * Trebuchet MS
 * Verdana, Geneva
 * MS Sans Serif, Geneva
 * MS Serif, New York
 */