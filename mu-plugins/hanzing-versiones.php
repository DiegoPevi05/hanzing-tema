<?php
/**
 * Plugin Name: Hanzing · Versiones de la propuesta
 * Description: Permite ver las dos versiones del sitio en el mismo enlace: ?version=sobria y ?version=animada. La elección se recuerda con una cookie. Solo actúa en la parte pública; al aprobar una versión, se activa ese tema y se borra este archivo.
 * Author: Medialitica.pe
 */

defined( 'ABSPATH' ) || exit;

const HZ_VERSIONES = array(
	'sobria'  => 'hanzing',
	'animada' => 'hanzing-animado',
);

/** Versión pedida por la visita (URL o cookie), o '' si no pidió ninguna. */
function hz_version_pedida() {
	static $v = null;
	if ( null !== $v ) {
		return $v;
	}
	$v = '';
	if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) || wp_doing_cron() ) {
		return $v;
	}
	$get = isset( $_GET['version'] ) ? sanitize_key( wp_unslash( $_GET['version'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	if ( isset( HZ_VERSIONES[ $get ] ) ) {
		$v = $get;
		if ( ! headers_sent() ) {
			setcookie( 'hz_version', $v, time() + 30 * DAY_IN_SECONDS, '/', '', is_ssl(), true );
		}
	} elseif ( isset( $_COOKIE['hz_version'], HZ_VERSIONES[ $_COOKIE['hz_version'] ] ) ) {
		$v = $_COOKIE['hz_version'];
	}
	if ( $v && ! is_dir( WP_CONTENT_DIR . '/themes/' . HZ_VERSIONES[ $v ] ) ) {
		$v = '';
	}
	return $v;
}

// La versión pedida decide el tema de esa visita. El tema activo en el admin no cambia.
add_filter( 'stylesheet', function ( $actual ) {
	$v = hz_version_pedida();
	return $v ? HZ_VERSIONES[ $v ] : $actual;
} );
add_filter( 'template', fn( $t ) => hz_version_pedida() ? 'hanzing' : $t );

// Las dos versiones comparten los ajustes (logo, contacto, portada) del tema Hanzing.
add_filter( 'pre_option_theme_mods_hanzing-animado', function ( $pre ) {
	$mods = get_option( 'theme_mods_hanzing' );
	return is_array( $mods ) ? $mods : $pre;
} );

// Mientras se comparan versiones, que ningún caché sirva una en lugar de la otra.
add_action( 'send_headers', function () {
	if ( ! is_admin() ) {
		nocache_headers();
		do_action( 'litespeed_control_set_nocache', 'hanzing: comparación de versiones' );
	}
} );

// Selector discreto al pie de la pantalla.
add_action( 'wp_footer', function () {
	$actual = array_search( get_stylesheet(), HZ_VERSIONES, true ) ?: 'sobria';
	$url    = remove_query_arg( 'version' );
	echo '<nav aria-label="Versión de la propuesta" style="position:fixed;left:16px;bottom:16px;z-index:45;display:flex;align-items:center;gap:4px;padding:6px;border-radius:6px;background:#0c1120;color:#fff;font:600 14px/1 \'Source Sans 3\',system-ui,sans-serif">';
	echo '<span style="padding:0 8px;color:#b9c1d3;font-weight:400">Versión</span>';
	foreach ( array( 'sobria' => 'Sobria', 'animada' => 'Animada' ) as $k => $label ) {
		$on = $k === $actual;
		printf(
			'<a href="%s"%s style="padding:9px 12px;border-radius:4px;text-decoration:none;%s">%s</a>',
			esc_url( add_query_arg( 'version', $k, $url ) ),
			$on ? ' aria-current="true"' : '',
			$on ? 'background:#f19700;color:#121826' : 'color:#fff',
			esc_html( $label )
		);
	}
	echo '</nav>';
}, 99 );
