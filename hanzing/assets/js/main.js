/* Hanzing · comportamiento del tema. Sin dependencias. */
( function () {
	'use strict';

	const reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/** Marca un elemento cuando entra a la pantalla, una sola vez. */
	function onEnter( els, cb, options ) {
		if ( ! ( 'IntersectionObserver' in window ) ) {
			els.forEach( cb );
			return;
		}
		const io = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( e ) => {
				if ( e.isIntersecting ) {
					cb( e.target );
					io.unobserve( e.target );
				}
			} );
		}, options || { rootMargin: '0px 0px -10% 0px', threshold: 0.12 } );
		els.forEach( ( el ) => io.observe( el ) );
	}

	/* ---------- Cabecera y menú ---------- */
	const header = document.querySelector( '[data-header]' );
	const menuBtn = header && header.querySelector( '.menu-btn' );
	const nav = document.getElementById( 'menu' );
	const setMenu = ( open ) => {
		menuBtn.setAttribute( 'aria-expanded', String( open ) );
		nav.classList.toggle( 'is-open', open );
		document.body.style.overflow = open ? 'hidden' : '';
	};
	if ( menuBtn && nav ) {
		menuBtn.addEventListener( 'click', () => setMenu( menuBtn.getAttribute( 'aria-expanded' ) !== 'true' ) );
		document.addEventListener( 'keydown', ( e ) => {
			if ( e.key === 'Escape' && menuBtn.getAttribute( 'aria-expanded' ) === 'true' ) {
				setMenu( false );
				menuBtn.focus();
			}
		} );
	}
	if ( header ) {
		const onScroll = () => header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	/* ---------- WhatsApp flotante: aparece al pasar la primera pantalla ---------- */
	const wa = document.querySelector( '.wa-float' );
	if ( wa ) {
		const onWa = () => wa.classList.toggle( 'is-visible', window.scrollY > window.innerHeight * 0.7 );
		onWa();
		window.addEventListener( 'scroll', onWa, { passive: true } );
	}

	/* ---------- Entradas escalonadas ---------- */
	onEnter( document.querySelectorAll( '[data-reveal]' ), ( el ) => el.classList.add( 'is-in' ) );

	/* ---------- Hero: fundido lento entre fotos de aplicación ---------- */
	document.querySelectorAll( '[data-slides]' ).forEach( ( wrap ) => {
		const imgs = [ ...wrap.querySelectorAll( 'img' ) ];
		if ( imgs.length < 2 || reduce ) return;
		let i = 0;
		let timer = setInterval( next, 6000 );
		function next() {
			imgs[ i ].classList.remove( 'is-active' );
			i = ( i + 1 ) % imgs.length;
			imgs[ i ].classList.add( 'is-active' );
		}
		document.addEventListener( 'visibilitychange', () => {
			clearInterval( timer );
			if ( ! document.hidden ) timer = setInterval( next, 6000 );
		} );
	} );

	/* ---------- Momento: escala de paso de luz ---------- */
	onEnter( document.querySelectorAll( '.luz__ramp' ), ( el ) => el.classList.add( 'is-in' ) );
	document.querySelectorAll( '[data-luz]' ).forEach( ( root ) => {
		const choices = [ ...root.querySelectorAll( '.luz__choice' ) ];
		const sheet = root.querySelector( '.luz__sheet' );
		const pct = root.querySelector( '[data-luz-pct]' );
		const text = root.querySelector( '[data-luz-text]' );
		const lonas = root.querySelector( '[data-luz-lonas]' );
		const select = ( btn ) => {
			choices.forEach( ( b ) => b.setAttribute( 'aria-pressed', String( b === btn ) ) );
			sheet.style.setProperty( '--o', btn.dataset.opacity );
			sheet.style.setProperty( '--sheet', btn.dataset.color );
			pct.textContent = btn.dataset.pct;
			text.textContent = btn.dataset.text;
			lonas.innerHTML = btn.dataset.lonas;
		};
		choices.forEach( ( b ) => b.addEventListener( 'click', () => select( b ) ) );
	} );

	/* ---------- Momento: acomodo sobre el rollo ---------- */
	onEnter( document.querySelectorAll( '[data-marker]' ), ( el ) => el.classList.add( 'is-in' ), { threshold: 0.15 } );

	/* ---------- Momento: jalar y se forma la carpa ---------- */
	document.querySelectorAll( '[data-carpa]' ).forEach( ( root ) => {
		const range = root.querySelector( '.carpa__range' );
		const sheet = root.querySelector( '.carpa__sheet' );
		const seam = root.querySelector( '.carpa__seam' );
		const shadow = root.querySelector( '.carpa__shadow' ); // taste-skill-ignore: sombra del dibujo SVG
		const cord = root.querySelector( '.carpa__cord' );
		const pole = ( k ) => root.querySelector( `[data-pole="${ k }"]` );
		const guy = ( k ) => root.querySelector( `[data-guy="${ k }"]` );
		const status = root.querySelector( '.carpa__status' );
		const steps = JSON.parse( root.dataset.steps );
		const GROUND = 372;
		const ease = ( t ) => 1 - Math.pow( 1 - t, 3 );
		const lerp = ( a, b, t ) => a + ( b - a ) * t;
		const pt = ( p ) => `${ p[ 0 ].toFixed( 1 ) },${ p[ 1 ].toFixed( 1 ) }`;

		function draw( raw ) {
			const t = ease( raw );
			// Lona tendida en el piso (t = 0) → carpa tensada (t = 1).
			const le = [ lerp( 90, 170, t ), lerp( 368, 222, t ) ];
			const pk = [ 400, lerp( 364, 96, t ) ];
			const re = [ lerp( 710, 630, t ), lerp( 368, 222, t ) ];
			// Caída del techo: la tensión la endereza, sin tensión se comba.
			const sag = 14 + 18 * ( 1 - t );
			const c1 = [ ( le[ 0 ] + pk[ 0 ] ) / 2 + 8 * t, ( le[ 1 ] + pk[ 1 ] ) / 2 + sag * t ];
			const c2 = [ ( pk[ 0 ] + re[ 0 ] ) / 2 - 8 * t, ( pk[ 1 ] + re[ 1 ] ) / 2 + sag * t ];
			// Faldón festoneado entre las esquinas.
			let valance = '';
			const n = 6;
			for ( let k = 0; k < n; k++ ) {
				const xa = lerp( re[ 0 ], le[ 0 ], k / n );
				const xb = lerp( re[ 0 ], le[ 0 ], ( k + 1 ) / n );
				valance += ` L${ pt( [ xa, re[ 1 ] + 6 * t ] ) } Q${ pt( [ ( xa + xb ) / 2, re[ 1 ] + 30 * t ] ) } ${ pt( [ xb, re[ 1 ] + 6 * t ] ) }`;
			}
			sheet.setAttribute( 'd', `M${ pt( le ) } Q${ pt( c1 ) } ${ pt( pk ) } Q${ pt( c2 ) } ${ pt( re ) }${ valance } Z` );
			seam.setAttribute( 'd', `M${ pt( pk ) } L${ pt( [ lerp( le[ 0 ], re[ 0 ], 1 / 3 ), le[ 1 ] ] ) } M${ pt( pk ) } L${ pt( [ lerp( le[ 0 ], re[ 0 ], 2 / 3 ), le[ 1 ] ] ) }` );
			seam.style.opacity = String( t );

			pole( 'l' ).setAttribute( 'x1', le[ 0 ] ); pole( 'l' ).setAttribute( 'x2', le[ 0 ] ); pole( 'l' ).setAttribute( 'y2', le[ 1 ] );
			pole( 'r' ).setAttribute( 'x1', re[ 0 ] ); pole( 'r' ).setAttribute( 'x2', re[ 0 ] ); pole( 'r' ).setAttribute( 'y2', re[ 1 ] );
			pole( 'c' ).setAttribute( 'y2', lerp( GROUND, pk[ 1 ] + 6, t ) );
			[ 'l', 'r', 'c' ].forEach( ( k ) => ( pole( k ).style.opacity = String( Math.min( 1, t * 4 ) ) ) );

			guy( 'l' ).setAttribute( 'x1', le[ 0 ] ); guy( 'l' ).setAttribute( 'y1', le[ 1 ] );
			guy( 'r' ).setAttribute( 'x1', re[ 0 ] ); guy( 'r' ).setAttribute( 'y1', re[ 1 ] );
			guy( 'l' ).style.opacity = guy( 'r' ).style.opacity = String( t );

			// El cordón va de la cumbrera a la polea de la estaca; se tensa al jalarlo.
			cord.setAttribute( 'd', `M${ pt( pk ) } Q${ pt( [ 600, lerp( 392, 200, t ) ] ) } 760,360` );
			shadow.setAttribute( 'rx', String( lerp( 320, 280, t ) ) );
			shadow.setAttribute( 'ry', String( lerp( 4, 20, t ) ) );

			range.style.setProperty( '--p', `${ raw * 100 }%` );
			const step = steps.find( ( s ) => raw <= s.max ) || steps[ steps.length - 1 ];
			if ( status.textContent !== step.text ) status.textContent = step.text;
			root.classList.toggle( 'is-built', raw >= 0.98 );
		}

		range.addEventListener( 'input', () => draw( range.value / 100 ) );
		draw( range.value / 100 );

		// Una pista de una sola vez: el cordón da un tirón al aparecer.
		if ( ! reduce ) {
			onEnter( [ root ], () => {
				if ( Number( range.value ) !== 0 ) return;
				const start = performance.now();
				const tick = ( now ) => {
					const k = Math.min( 1, ( now - start ) / 1200 );
					const v = Math.sin( k * Math.PI ) * 0.22;
					if ( Number( range.value ) === 0 ) draw( v );
					if ( k < 1 ) requestAnimationFrame( tick );
					else if ( Number( range.value ) === 0 ) draw( 0 );
				};
				requestAnimationFrame( tick );
			}, { threshold: 0.5 } );
		}
	} );

	/* ---------- Equipo: la cortina azul se retira y descubre la foto ---------- */
	onEnter( document.querySelectorAll( '.equipo__foto' ), ( el ) => el.classList.add( 'is-in' ), { threshold: 0.35 } );

	/* ---------- Regla de 50 m y vista explotada de las capas ---------- */
	onEnter( document.querySelectorAll( '[data-regla], [data-capas]' ), ( el ) => el.classList.add( 'is-in' ), { threshold: 0.4 } );
	document.querySelectorAll( '[data-cuenta]' ).forEach( ( el ) => {
		const fin = parseInt( el.dataset.cuenta, 10 );
		if ( reduce || ! fin ) return;
		el.textContent = '0';
		onEnter( [ el ], () => {
			const t0 = performance.now();
			const paso = ( t ) => {
				const k = Math.min( 1, ( t - t0 ) / 1800 );
				el.textContent = String( Math.round( fin * ( 1 - Math.pow( 1 - k, 4 ) ) ) );
				if ( k < 1 ) requestAnimationFrame( paso );
			};
			requestAnimationFrame( paso );
		}, { threshold: 0.6 } );
	} );

	/* ---------- Videos en bucle: solo corren en pantalla y sin movimiento reducido ---------- */
	document.querySelectorAll( 'video[data-autoplay]' ).forEach( ( v ) => {
		if ( reduce ) return; // con movimiento reducido se queda el cuadro de portada
		if ( ! ( 'IntersectionObserver' in window ) ) { v.play().catch( () => {} ); return; }
		new IntersectionObserver( ( entries ) => {
			entries.forEach( ( e ) => ( e.isIntersecting ? v.play().catch( () => {} ) : v.pause() ) );
		}, { threshold: 0.25 } ).observe( v );
	} );

	/* ---------- Video de YouTube bajo demanda ---------- */
	document.querySelectorAll( '[data-yt]' ).forEach( ( el ) => {
		const btn = el.querySelector( 'button' );
		if ( ! btn ) return;
		btn.addEventListener( 'click', () => {
			const iframe = document.createElement( 'iframe' );
			iframe.src = `https://www.youtube-nocookie.com/embed/${ el.dataset.yt }?autoplay=1`;
			iframe.title = 'Video de Lonas FIERAFLEX';
			iframe.allow = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture';
			iframe.allowFullscreen = true;
			el.replaceChildren( iframe );
		} );
	} );

	/* ---------- Medición para Google Ads / Analytics ----------
	   Cada clic a WhatsApp, teléfono o correo y cada envío del formulario se manda a
	   dataLayer (Google Tag Manager) y, si hay etiqueta de Google, como evento de gtag.
	   La conversión de Google Ads se configura en Apariencia › Personalizar › Medición. */
	const conv = window.hzMedicion || {};
	function medir( accion, ubicacion, producto ) {
		const datos = { accion, ubicacion, producto: producto || '', pagina: location.pathname };
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push( Object.assign( { event: 'hz_contacto' }, datos ) );
		if ( typeof window.gtag === 'function' ) {
			window.gtag( 'event', accion, datos );
			const envio = accion.indexOf( 'whatsapp' ) > -1 ? conv.whatsapp : conv.contacto;
			if ( envio ) window.gtag( 'event', 'conversion', { send_to: envio } );
		}
	}
	function zona( el ) {
		if ( el.closest( '.wa-float' ) ) return 'flotante';
		if ( el.closest( '.site-header, .topbar' ) ) return 'cabecera';
		if ( el.closest( '.site-footer' ) ) return 'pie';
		const sec = el.closest( 'section' );
		return sec ? ( sec.getAttribute( 'aria-labelledby' ) || sec.className.split( ' ' )[ 0 ] || 'seccion' ).replace( /-title$/, '' ) : 'pagina';
	}
	document.addEventListener( 'click', ( e ) => {
		const a = e.target.closest( 'a[href]' );
		if ( ! a ) return;
		const href = a.getAttribute( 'href' );
		const accion = /wa\.me|whatsapp\.com/.test( href ) ? 'clic_whatsapp' : href.startsWith( 'tel:' ) ? 'clic_telefono' : href.startsWith( 'mailto:' ) ? 'clic_correo' : '';
		if ( accion ) medir( accion, zona( a ), document.body.dataset.producto );
	} );

	/* ---------- Formulario de cotización ---------- */
	const form = document.getElementById( 'cotizar' );
	if ( form ) {
		const error = form.querySelector( '.form__error' );
		form.addEventListener( 'submit', ( e ) => {
			e.preventDefault();
			const data = new FormData( form );
			const get = ( k ) => String( data.get( k ) || '' ).trim();
			if ( ! get( 'nombre' ) || ! get( 'mensaje' ) ) {
				error.hidden = false;
				form.querySelector( get( 'nombre' ) ? '#mensaje' : '#nombre' ).focus();
				return;
			}
			error.hidden = true;
			const texto = [
				`Hola, soy ${ get( 'nombre' ) }${ get( 'empresa' ) ? ` de ${ get( 'empresa' ) }` : '' }.`,
				get( 'ciudad' ) ? `Ciudad: ${ get( 'ciudad' ) }` : null,
				`Lona: ${ get( 'lona' ) || 'Necesito asesoría' }`,
				get( 'rollos' ) ? `Rollos: ${ get( 'rollos' ) }` : null,
				'',
				get( 'mensaje' ),
			].filter( ( l ) => l !== null ).join( '\n' );
			const viaEmail = e.submitter && e.submitter.dataset.via === 'email';
			const url = viaEmail
				? `mailto:${ form.dataset.email }?subject=${ encodeURIComponent( 'Cotización de lona FIERAFLEX' ) }&body=${ encodeURIComponent( texto ) }`
				: `https://wa.me/${ form.dataset.whatsapp }?text=${ encodeURIComponent( texto ) }`;
			medir( viaEmail ? 'formulario_correo' : 'formulario_whatsapp', 'formulario', get( 'lona' ) );
			window.open( url, viaEmail ? '_self' : '_blank', 'noopener' );
		} );
	}
} )();
