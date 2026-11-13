<?php
/**
 * Utilidades de plantillas.
 */

defined( 'ABSPATH' ) || exit;

/** Icono SVG en línea. */
function hanzing_icon( $name ) {
	$paths = array(
		'whatsapp' => '<path fill="currentColor" d="M12.04 2a9.9 9.9 0 0 0-8.5 15l-1.4 5.1 5.24-1.37A9.9 9.9 0 1 0 12.04 2Zm0 18.13a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.11.82.83-3.03-.2-.31a8.23 8.23 0 1 1 6.97 3.85Zm4.51-6.16c-.25-.12-1.47-.72-1.7-.8-.22-.09-.39-.13-.55.12-.17.25-.64.8-.78.97-.15.16-.29.18-.54.06a6.73 6.73 0 0 1-3.36-2.94c-.25-.44.25-.4.72-1.34.08-.16.04-.3-.02-.43-.06-.12-.55-1.33-.76-1.82-.2-.48-.4-.41-.55-.42h-.47a.9.9 0 0 0-.65.3 2.74 2.74 0 0 0-.86 2.04 4.77 4.77 0 0 0 1 2.53 10.9 10.9 0 0 0 4.17 3.68c1.55.67 2.16.73 2.93.61.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.17-.47-.29Z"/>',
		'phone'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 5a2 2 0 0 1 2-2Z"/>',
		'mail'     => '<path fill="none" stroke="currentColor" stroke-width="2" d="M3 5h18v14H3z M3 6l9 7 9-7"/>',
		'play'     => '<path fill="currentColor" d="M8 5v14l11-7z"/>',
		'envio'    => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M2 6h11v9H2zM13 9h4l3 3v3h-7M6.5 18.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM16.5 18.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"/>',
		'asesoria' => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M4 13v-1a8 8 0 0 1 16 0v1M4 13h3v6H4zM17 13h3v6h-3zM20 19a3 3 0 0 1-3 3h-4"/>',
		'rollos'   => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M3 7l9-4 9 4-9 4zM3 7v10l9 4 9-4V7M12 11v10"/>',
		'persona'  => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21a8 8 0 0 1 16 0"/>',
		'calendario' => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M4 6h16v14H4zM4 10h16M8 3v4M16 3v4"/>',
		'pdf'      => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M6 3h8l4 4v14H6zM14 3v4h4M9 14l3 3 3-3M12 10v7"/>',
		'industria' => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M3 21V10l6 4V10l6 4V6l6 4v11zM7 18h2M12 18h2M17 18h2"/>',
		'regla'    => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M2 8h20v8H2zM6 8v3M10 8v4M14 8v3M18 8v4"/>',
		'reloj'    => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18ZM12 7v5l3 2"/>',
		'cajas'    => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M3 11h8v9H3zM13 11h8v9h-8zM8 3h8v8H8z"/>',
		'libro'    => '<path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" d="M5 4h11a3 3 0 0 1 3 3v13H8a3 3 0 0 1-3-3zM5 17a3 3 0 0 1 3-3h11M9 8h6"/>',
		'grain'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M7 8l5-5 5 5M7 16l5 5 5-5"/>',
	);
	return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . ( $paths[ $name ] ?? '' ) . '</svg>';
}

/** ID de una foto del tema cargada por el importador. */
function hanzing_foto_id( $key ) {
	$fotos = get_option( 'hanzing_fotos', array() );
	return (int) ( $fotos[ $key ] ?? 0 );
}

/** Imagen de la biblioteca con atributos de rendimiento. */
function hanzing_img( $id, $sizes = '100vw', $attrs = array() ) {
	if ( ! $id ) {
		return '';
	}
	return wp_get_attachment_image( $id, 'full', false, array_merge( array( 'sizes' => $sizes, 'loading' => 'lazy', 'decoding' => 'async' ), $attrs ) );
}

/** Grupos de luz para la escala: posición en 11 pasos y efecto sobre la foto. */
function hanzing_grupos_luz() {
	return array(
		'transparente' => array( 'nombre' => 'Transparente', 'paso' => 1, 'pct' => 'Casi toda', 'opacidad' => 0.12, 'color' => '#ffffff', 'texto' => 'Se ve a través: ideal para ventanas de carpa y cerramientos.' ),
		'traslucida'   => array( 'nombre' => 'Translúcida', 'paso' => 4, 'pct' => 'Filtrada', 'opacidad' => 0.62, 'color' => '#e7efe0', 'texto' => 'Pasa luz suave y difusa, sin ver a través. Viene en varios colores.' ),
		'opaca'        => array( 'nombre' => 'Opaca', 'paso' => 11, 'pct' => 'Nada', 'opacidad' => 0.97, 'color' => '#141a33', 'texto' => 'Bloquea toda la luz: sombra total para carpas, naves y cubiertas.' ),
	);
}

/** Tonos de la escala, de luz plena a opaco. */
function hanzing_rampa() {
	return array( '#ffffff', '#eef1f6', '#dde2ea', '#c7cedb', '#adb6c8', '#919cb3', '#76829c', '#5b6784', '#424d6b', '#2b3452', '#131a3a' );
}
