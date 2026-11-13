<?php
/**
 * Textos e imágenes de la portada: Apariencia > Personalizar > Portada.
 */

defined( 'ABSPATH' ) || exit;

function hanzing_portada( $key ) {
	$defaults = array(
		'titulo' => 'La lona adecuada para cada proyecto',
		'texto'  => 'Rollos de lona de PVC de 50 metros para toldos, velarias, carpas, domos e inflables. Sin pedido mínimo y con envío a todo México.',
	);
	return get_theme_mod( 'hz_portada_' . $key, $defaults[ $key ] ?? '' );
}

/** IDs de las fotos del hero: las elegidas en el Personalizador o las fotos de aplicación de las lonas. */
function hanzing_portada_fotos() {
	$ids = array_filter( array_map( 'absint', array(
		get_theme_mod( 'hz_portada_foto1' ),
		get_theme_mod( 'hz_portada_foto2' ),
		get_theme_mod( 'hz_portada_foto3' ),
	) ) );
	if ( ! $ids ) {
		$ids = array_filter( array( hanzing_foto_id( 'carpa-boda' ), hanzing_foto_id( 'cubierta-industrial' ), hanzing_foto_id( 'toldo-fachada' ) ) );
	}
	return array_values( $ids );
}

/** Datos de confianza: solo se muestran los que tienen valor. */
function hanzing_confianza() {
	$anio = absint( get_theme_mod( 'hz_anio' ) );
	$pdf  = absint( get_theme_mod( 'hz_catalogo_pdf' ) );
	return array(
		'anio'   => $anio,
		'envios' => get_theme_mod( 'hz_envios', 'Envíos a todo México' ),
		'pdf'    => $pdf ? wp_get_attachment_url( $pdf ) : '',
	);
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_section( 'hz_empresa', array( 'title' => 'Empresa y confianza', 'priority' => 26 ) );
	$wp->add_setting( 'hz_anio', array( 'sanitize_callback' => 'absint' ) );
	$wp->add_control( 'hz_anio', array( 'label' => 'Año de fundación (vacío = no se muestra)', 'section' => 'hz_empresa', 'type' => 'number' ) );
	$wp->add_setting( 'hz_envios', array( 'default' => 'Envíos a todo México', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp->add_control( 'hz_envios', array( 'label' => 'Cobertura de envíos', 'section' => 'hz_empresa' ) );
	$wp->add_setting( 'hz_catalogo_pdf', array( 'sanitize_callback' => 'absint' ) );
	$wp->add_control( new WP_Customize_Media_Control( $wp, 'hz_catalogo_pdf', array( 'label' => 'Catálogo en PDF (opcional)', 'section' => 'hz_empresa', 'mime_type' => 'application/pdf' ) ) );
});

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_section( 'hz_portada', array( 'title' => 'Portada', 'priority' => 25 ) );
	$wp->add_setting( 'hz_portada_titulo', array( 'default' => hanzing_portada( 'titulo' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp->add_control( 'hz_portada_titulo', array( 'label' => 'Titular (máximo dos líneas)', 'section' => 'hz_portada' ) );
	$wp->add_setting( 'hz_portada_texto', array( 'default' => hanzing_portada( 'texto' ), 'sanitize_callback' => 'sanitize_textarea_field' ) );
	$wp->add_control( 'hz_portada_texto', array( 'label' => 'Texto bajo el titular', 'section' => 'hz_portada', 'type' => 'textarea' ) );
	foreach ( array( 1, 2, 3 ) as $n ) {
		$wp->add_setting( "hz_portada_foto$n", array( 'sanitize_callback' => 'absint' ) );
		$wp->add_control( new WP_Customize_Media_Control( $wp, "hz_portada_foto$n", array(
			'label'     => "Foto de portada $n",
			'section'   => 'hz_portada',
			'mime_type' => 'image',
		) ) );
	}
} );
