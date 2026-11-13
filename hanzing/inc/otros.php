<?php
/**
 * Otros rollos y accesorios (sin ficha propia): Apariencia › Personalizar › Otros productos.
 */

defined( 'ABSPATH' ) || exit;

function hanzing_otros_defaults() {
	return implode( "\n", array(
		'Hule cristal | Rollo de PVC transparente.',
		'Membrana | Rollo de membrana. Pregunta por especificaciones.',
		'Lona de uso rudo para camiones | Para cubrir cajas y cargas.',
		'Motores de aire (sopladores) | Para inflables y brincolines.',
		'Cinta mochilera | Complemento para confección.',
	) );
}

/** Lista de [nombre, descripción]. */
function hanzing_otros() {
	$rows = array();
	foreach ( explode( "\n", (string) get_theme_mod( 'hz_otros', hanzing_otros_defaults() ) ) as $line ) {
		$p = array_map( 'trim', explode( '|', $line ) );
		if ( '' !== $p[0] ) {
			$rows[] = array( $p[0], $p[1] ?? '' );
		}
	}
	return $rows;
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_section( 'hz_otros', array( 'title' => 'Otros productos', 'priority' => 27 ) );
	$wp->add_setting( 'hz_otros', array( 'default' => hanzing_otros_defaults(), 'sanitize_callback' => 'sanitize_textarea_field' ) );
	$wp->add_control( 'hz_otros', array( 'label' => 'Uno por línea: Nombre | Descripción corta', 'section' => 'hz_otros', 'type' => 'textarea' ) );
} );
