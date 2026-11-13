<?php
/**
 * Medición: Google Tag Manager, etiqueta de Google (Analytics / Ads) y conversiones de contacto.
 * Apariencia › Personalizar › Medición. Campos vacíos = no se carga nada.
 */

defined( 'ABSPATH' ) || exit;

function hanzing_medicion( $key ) {
	return trim( (string) get_theme_mod( 'hz_med_' . $key, '' ) );
}

add_action( 'wp_head', function () {
	$gtm  = hanzing_medicion( 'gtm' );
	$gtag = hanzing_medicion( 'gtag' );
	$conv = array_filter( array(
		'whatsapp' => hanzing_medicion( 'conv_whatsapp' ),
		'contacto' => hanzing_medicion( 'conv_contacto' ),
	) );
	if ( $conv ) {
		echo '<script>window.hzMedicion=' . wp_json_encode( $conv ) . ";</script>\n";
	}
	if ( preg_match( '/^GTM-[A-Z0-9]+$/', $gtm ) ) {
		echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js( $gtm ) . "');</script>\n";
	}
	$ids = array_filter( array_map( 'trim', explode( ',', $gtag ) ), fn( $id ) => preg_match( '/^(G|AW)-[A-Z0-9]+$/', $id ) );
	if ( $ids ) {
		$first = reset( $ids );
		echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr( $first ) . '"></script>' . "\n";
		echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());";
		foreach ( $ids as $id ) {
			echo "gtag('config','" . esc_js( $id ) . "');";
		}
		echo "</script>\n";
	}
}, 2 );

add_action( 'wp_body_open', function () {
	$gtm = hanzing_medicion( 'gtm' );
	if ( preg_match( '/^GTM-[A-Z0-9]+$/', $gtm ) ) {
		echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $gtm ) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
	}
} );

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_section( 'hz_medicion', array(
		'title'       => 'Medición (Google Ads)',
		'priority'    => 35,
		'description' => 'Cada clic a WhatsApp, teléfono o correo y cada envío del formulario se registra como evento "hz_contacto" en dataLayer y como evento de gtag (clic_whatsapp, clic_telefono, clic_correo, formulario_whatsapp, formulario_correo).',
	) );
	$campos = array(
		'gtm'           => array( 'Google Tag Manager (GTM-XXXXXXX)', 'Si usas Tag Manager, basta con este campo.' ),
		'gtag'          => array( 'Etiqueta de Google (G-XXXX y/o AW-XXXX, separadas por coma)', 'Para medir sin Tag Manager.' ),
		'conv_whatsapp' => array( 'Conversión de Google Ads para WhatsApp (AW-XXXX/etiqueta)', 'Se dispara en cada clic a WhatsApp.' ),
		'conv_contacto' => array( 'Conversión de Google Ads para llamada / correo (AW-XXXX/etiqueta)', 'Opcional.' ),
	);
	foreach ( $campos as $k => $c ) {
		$wp->add_setting( 'hz_med_' . $k, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp->add_control( 'hz_med_' . $k, array( 'label' => $c[0], 'description' => $c[1], 'section' => 'hz_medicion' ) );
	}
} );
