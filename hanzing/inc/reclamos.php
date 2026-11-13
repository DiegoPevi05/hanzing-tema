<?php
/**
 * Libro de reclamaciones: cada hoja se guarda como entrada privada con número correlativo,
 * se envía por correo a ventas y el cliente recibe una copia.
 * Razón social y RFC: Apariencia › Personalizar › Empresa y confianza (vacíos = no se muestran).
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'hz_reclamo', array(
		'labels'          => array(
			'name'          => 'Reclamos',
			'singular_name' => 'Reclamo',
			'menu_name'     => 'Libro de reclamaciones',
			'all_items'     => 'Todas las hojas',
			'edit_item'     => 'Hoja de reclamación',
			'search_items'  => 'Buscar hojas',
		),
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_icon'       => 'dashicons-book-alt',
		'menu_position'   => 56,
		'supports'        => array( 'title' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/** Campos del formulario: nombre => etiqueta. */
function hanzing_reclamo_campos() {
	return array(
		'nombre'            => 'Nombre completo',
		'empresa'           => 'Empresa o razón social',
		'tipo_documento'    => 'Tipo de identificación',
		'numero_documento'  => 'Número de identificación',
		'telefono'          => 'Teléfono',
		'correo'            => 'Correo electrónico',
		'domicilio'         => 'Domicilio (ciudad y estado)',
		'tipo_bien'         => 'Producto o servicio',
		'monto'             => 'Monto reclamado (MXN)',
		'numero_pedido'     => 'N.° de pedido o factura',
		'descripcion_bien'  => 'Descripción del producto o servicio',
		'tipo_incidencia'   => 'Tipo',
		'detalle'           => 'Detalle',
		'pedido_consumidor' => 'Lo que solicita el cliente',
	);
}

function hanzing_reclamo_obligatorios() {
	return array( 'nombre', 'numero_documento', 'telefono', 'correo', 'domicilio', 'descripcion_bien', 'detalle', 'pedido_consumidor' );
}

function hanzing_reclamo_procesar() {
	$volver = remove_query_arg( array( 'reclamo', 'hoja' ), wp_get_referer() ?: home_url( '/libro-de-reclamaciones/' ) );

	if ( ! isset( $_POST['hz_reclamo_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['hz_reclamo_nonce'] ), 'hz_reclamo' ) ) {
		wp_safe_redirect( add_query_arg( 'reclamo', 'error', $volver ) );
		exit;
	}
	// Trampa para robots: el campo "web" está oculto para personas.
	if ( ! empty( $_POST['web'] ) ) {
		wp_safe_redirect( add_query_arg( 'reclamo', 'error', $volver ) );
		exit;
	}

	$datos = array();
	foreach ( hanzing_reclamo_campos() as $campo => $etiqueta ) {
		$valor           = isset( $_POST[ $campo ] ) ? wp_unslash( $_POST[ $campo ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$datos[ $campo ] = in_array( $campo, array( 'detalle', 'pedido_consumidor' ), true ) ? sanitize_textarea_field( $valor ) : sanitize_text_field( $valor );
	}
	foreach ( hanzing_reclamo_obligatorios() as $campo ) {
		if ( '' === $datos[ $campo ] ) {
			wp_safe_redirect( add_query_arg( 'reclamo', 'incompleto', $volver ) );
			exit;
		}
	}
	if ( ! is_email( $datos['correo'] ) || empty( $_POST['declaracion'] ) ) {
		wp_safe_redirect( add_query_arg( 'reclamo', 'incompleto', $volver ) );
		exit;
	}

	$numero = (int) get_option( 'hz_reclamo_correlativo', 0 ) + 1;
	update_option( 'hz_reclamo_correlativo', $numero, false );
	$hoja = sprintf( '%06d', $numero );

	$id = wp_insert_post( array(
		'post_type'   => 'hz_reclamo',
		'post_status' => 'private',
		'post_title'  => sprintf( 'Hoja N.° %s — %s (%s)', $hoja, $datos['nombre'], ucfirst( $datos['tipo_incidencia'] ?: 'reclamo' ) ),
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_hz_hoja', $hoja );
		foreach ( $datos as $campo => $valor ) {
			update_post_meta( $id, '_hz_' . $campo, $valor );
		}
	}

	$lineas = array( 'Hoja de reclamación N.° ' . $hoja, 'Fecha: ' . wp_date( 'd/m/Y H:i' ), '' );
	foreach ( hanzing_reclamo_campos() as $campo => $etiqueta ) {
		if ( '' !== $datos[ $campo ] ) {
			$lineas[] = $etiqueta . ': ' . $datos[ $campo ];
		}
	}
	$cuerpo  = implode( "\n", $lineas );
	$destino = hanzing_contacto( 'email' ) ?: get_option( 'admin_email' );
	wp_mail( $destino, 'Nuevo reclamo — Hoja N.° ' . $hoja, $cuerpo, array( 'Reply-To: ' . $datos['correo'] ) );
	wp_mail( $datos['correo'], 'FIERAFLEX — Copia de tu hoja de reclamación N.° ' . $hoja, $cuerpo . "\n\nRecibimos tu hoja y te responderemos a la brevedad.\nFIERAFLEX, una marca de Grupo Hanzing." );

	wp_safe_redirect( add_query_arg( array( 'reclamo' => 'ok', 'hoja' => $hoja ), $volver ) );
	exit;
}
add_action( 'admin_post_hz_reclamo', 'hanzing_reclamo_procesar' );
add_action( 'admin_post_nopriv_hz_reclamo', 'hanzing_reclamo_procesar' );

/** Aviso sobre el formulario después de enviarlo. */
function hanzing_reclamo_aviso() {
	$estado = isset( $_GET['reclamo'] ) ? sanitize_key( $_GET['reclamo'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	if ( ! $estado ) {
		return;
	}
	if ( 'ok' === $estado ) {
		$hoja = isset( $_GET['hoja'] ) ? preg_replace( '/\D/', '', wp_unslash( $_GET['hoja'] ) ) : ''; // phpcs:ignore
		printf( '<div class="aviso aviso--ok" role="status"><strong>Recibimos tu hoja de reclamación N.° %s</strong><p>Te enviamos una copia a tu correo y te responderemos a la brevedad.</p></div>', esc_html( $hoja ) );
		return;
	}
	$mensaje = 'incompleto' === $estado ? 'Faltan datos obligatorios. Revisa el formulario y vuelve a enviarlo.' : 'No pudimos registrar tu reclamo. Vuelve a intentarlo.';
	printf( '<div class="aviso aviso--error" role="alert"><p>%s</p></div>', esc_html( $mensaje ) );
}

/** Número que tendrá la próxima hoja. */
function hanzing_reclamo_siguiente() {
	return sprintf( '%06d', (int) get_option( 'hz_reclamo_correlativo', 0 ) + 1 );
}

// Detalle de la hoja en el admin.
add_action( 'add_meta_boxes_hz_reclamo', function () {
	add_meta_box( 'hz_reclamo_detalle', 'Detalle de la hoja', function ( WP_Post $post ) {
		echo '<table class="widefat striped"><tbody>';
		printf( '<tr><th style="width:240px">Hoja N.°</th><td>%s</td></tr>', esc_html( get_post_meta( $post->ID, '_hz_hoja', true ) ) );
		printf( '<tr><th>Fecha</th><td>%s</td></tr>', esc_html( get_the_date( 'd/m/Y H:i', $post ) ) );
		foreach ( hanzing_reclamo_campos() as $campo => $etiqueta ) {
			printf( '<tr><th>%s</th><td>%s</td></tr>', esc_html( $etiqueta ), nl2br( esc_html( get_post_meta( $post->ID, '_hz_' . $campo, true ) ) ) );
		}
		echo '</tbody></table>';
	}, 'hz_reclamo', 'normal', 'high' );
} );

// Razón social y RFC del proveedor (opcionales).
add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_setting( 'hz_razon_social', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp->add_control( 'hz_razon_social', array( 'label' => 'Razón social (libro de reclamaciones)', 'section' => 'hz_empresa' ) );
	$wp->add_setting( 'hz_rfc', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp->add_control( 'hz_rfc', array( 'label' => 'RFC (libro de reclamaciones)', 'section' => 'hz_empresa' ) );
}, 20 );
