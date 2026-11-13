<?php
/**
 * Hanzing Animado: tema hijo. Todo el contenido, los ajustes y las plantillas interiores vienen del tema Hanzing;
 * aquí solo vive la portada animada y sus estilos.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
	$uri = get_stylesheet_directory_uri();
	$dir = get_stylesheet_directory();
	wp_enqueue_style( 'hanzing-animado', "$uri/assets/css/animado.css", array( 'hanzing' ), filemtime( "$dir/assets/css/animado.css" ) );
	wp_enqueue_script( 'hanzing-animado', "$uri/assets/js/animado.js", array(), filemtime( "$dir/assets/js/animado.js" ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 20 );

/** Envuelve cada palabra para que el titular entre palabra por palabra. */
function hanzing_animado_palabras( $texto ) {
	$out = '';
	foreach ( preg_split( '/\s+/', trim( $texto ) ) as $n => $w ) {
		$out .= '<span class="w"><span style="--w:' . (int) $n . '">' . esc_html( $w ) . '</span></span> ';
	}
	return trim( $out );
}

/** Marca los números de una cifra para que cuenten al entrar en pantalla. */
function hanzing_animado_cifra( $texto ) {
	return preg_replace_callback( '/\d+/', fn( $m ) => '<span data-cuenta="' . (int) $m[0] . '">' . $m[0] . '</span>', esc_html( $texto ) );
}

/*
 * Los ajustes del sitio (logo, contacto, portada, medición) viven en el tema Hanzing:
 * esta versión los lee y los guarda ahí, para que las dos versiones muestren siempre lo mismo.
 */
add_filter( 'pre_option_theme_mods_hanzing-animado', function ( $pre ) {
	$mods = get_option( 'theme_mods_hanzing' );
	return is_array( $mods ) ? $mods : $pre;
} );
add_filter( 'pre_update_option_theme_mods_hanzing-animado', function ( $nuevo, $viejo ) {
	update_option( 'theme_mods_hanzing', $nuevo );
	return $viejo;
}, 10, 2 );
