<?php
/**
 * Testimonios de clientes. La sección solo aparece cuando hay alguno publicado.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'testimonio', array(
		'labels'       => array(
			'name'          => 'Testimonios',
			'singular_name' => 'Testimonio',
			'add_new'       => 'Agregar testimonio',
			'add_new_item'  => 'Agregar testimonio',
			'edit_item'     => 'Editar testimonio',
			'all_items'     => 'Todos los testimonios',
		),
		'public'              => false,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-format-quote',
		'menu_position'       => 6,
		'supports'            => array( 'title', 'editor' ),
		'show_in_rest'        => true,
		'exclude_from_search' => true,
	) );
	register_post_meta( 'testimonio', 'empresa', array( 'type' => 'string', 'single' => true, 'show_in_rest' => true ) );
} );

add_filter( 'enter_title_here', fn( $t, $post ) => 'testimonio' === $post->post_type ? 'Nombre de quien opina' : $t, 10, 2 );

add_action( 'add_meta_boxes_testimonio', function () {
	add_meta_box( 'hz-testimonio', 'Empresa y ciudad', function ( $post ) {
		wp_nonce_field( 'hanzing_testimonio', 'hanzing_testimonio_nonce' );
		printf(
			'<input type="text" name="hz_empresa" value="%s" style="width:100%%" placeholder="Ej. Inflables del Bajío, León"><p class="description">El texto del testimonio va en el editor. Publica solo opiniones reales con permiso del cliente.</p>',
			esc_attr( get_post_meta( $post->ID, 'empresa', true ) )
		);
	}, 'testimonio', 'normal', 'high' );
} );

add_action( 'save_post_testimonio', function ( $post_id ) {
	if ( ! isset( $_POST['hanzing_testimonio_nonce'] ) || ! wp_verify_nonce( $_POST['hanzing_testimonio_nonce'], 'hanzing_testimonio' ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta( $post_id, 'empresa', sanitize_text_field( wp_unslash( $_POST['hz_empresa'] ?? '' ) ) );
} );

function hanzing_testimonios() {
	return get_posts( array( 'post_type' => 'testimonio', 'posts_per_page' => 6, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) );
}
