<?php
/**
 * Datos de contacto editables desde Apariencia > Personalizar > Contacto.
 */

defined( 'ABSPATH' ) || exit;

function hanzing_contacto_defaults() {
	return array(
		'telefono'   => '477 111 1758',
		'whatsapp'   => '524771111758',
		'email'      => 'ventas01@grupohanzing.com',
		'email2'     => 'marketing01@grupohanzing.com',
		'direccion'  => "Fracc. Industrial Delta\nLeón, Guanajuato",
		'mapa'       => 'https://www.google.com/maps/search/?api=1&query=Industrial+Delta+Le%C3%B3n+Guanajuato',
		'horario'    => "Lunes a viernes | 9:00 a 18:00\nSábado | 9:00 a 13:00",
		'facebook'   => 'https://www.facebook.com/han.zing.267169',
		'instagram'  => 'https://www.instagram.com/lonasfieraflex/',
		'youtube'    => 'https://www.youtube.com/@lonashanzing2021',
		'youtube_id' => 'hjFjdlH33TI',
	);
}

function hanzing_contacto( $key ) {
	$defaults = hanzing_contacto_defaults();
	return get_theme_mod( 'hz_' . $key, $defaults[ $key ] ?? '' );
}

/** Enlace de WhatsApp con mensaje. */
function hanzing_whatsapp( $mensaje = 'Hola, quiero cotizar lona Fieraflex.' ) {
	return 'https://wa.me/' . preg_replace( '/\D/', '', hanzing_contacto( 'whatsapp' ) ) . '?text=' . rawurlencode( $mensaje );
}

function hanzing_telefono_href() {
	return 'tel:+52' . preg_replace( '/\D/', '', hanzing_contacto( 'telefono' ) );
}

/** Horario como pares [días, horas]. */
function hanzing_horario() {
	$rows = array();
	foreach ( explode( "\n", hanzing_contacto( 'horario' ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line ) );
		if ( $parts[0] ) {
			$rows[] = array( $parts[0], $parts[1] ?? '' );
		}
	}
	return $rows;
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_section( 'hz_contacto', array(
		'title'    => 'Contacto',
		'priority' => 30,
	) );
	$campos = array(
		'telefono'   => array( 'Teléfono', 'text' ),
		'whatsapp'   => array( 'WhatsApp (con lada de país, solo números)', 'text' ),
		'email'      => array( 'Correo de ventas', 'email' ),
		'email2'     => array( 'Correo secundario', 'email' ),
		'direccion'  => array( 'Dirección', 'textarea' ),
		'mapa'       => array( 'Enlace de Google Maps', 'url' ),
		'horario'    => array( 'Horario (una línea por día: días | horas)', 'textarea' ),
		'facebook'   => array( 'Facebook', 'url' ),
		'instagram'  => array( 'Instagram', 'url' ),
		'youtube'    => array( 'Canal de YouTube', 'url' ),
		'youtube_id' => array( 'ID del video de YouTube (página Nosotros)', 'text' ),
	);
	$defaults = hanzing_contacto_defaults();
	foreach ( $campos as $key => $c ) {
		$wp->add_setting( 'hz_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'url' === $c[1] ? 'esc_url_raw' : ( 'textarea' === $c[1] ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
		) );
		$wp->add_control( 'hz_' . $key, array(
			'label'   => $c[0],
			'section' => 'hz_contacto',
			'type'    => $c[1],
		) );
	}
} );
