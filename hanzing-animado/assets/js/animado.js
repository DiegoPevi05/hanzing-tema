/* Hanzing Animado: activa las animaciones SVG cuando entran en pantalla. */
( function () {
	const els = document.querySelectorAll( '[data-anim]' );
	if ( ! ( 'IntersectionObserver' in window ) ) {
		els.forEach( ( el ) => el.classList.add( 'is-in' ) );
		return;
	}
	const io = new IntersectionObserver( ( entries ) => {
		entries.forEach( ( e ) => {
			if ( e.isIntersecting ) {
				e.target.classList.add( 'is-in' );
				io.unobserve( e.target );
			}
		} );
	}, { threshold: 0.35 } );
	els.forEach( ( el ) => io.observe( el ) );
} )();
