<?php
/**
 * Industrias: cada lona se asigna a las industrias donde se usa.
 * Cada industria tiene foto y descripción editables en Lonas › Industrias.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_taxonomy( 'industria', 'lona', array(
		'labels'            => array(
			'name'          => 'Industrias',
			'singular_name' => 'Industria',
			'add_new_item'  => 'Agregar industria',
			'edit_item'     => 'Editar industria',
			'all_items'     => 'Todas las industrias',
			'search_items'  => 'Buscar industrias',
			'menu_name'     => 'Industrias',
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'industrias', 'with_front' => false ),
	) );
	register_term_meta( 'industria', 'foto_id', array( 'type' => 'integer', 'single' => true, 'show_in_rest' => true ) );
	register_term_meta( 'industria', 'orden', array( 'type' => 'integer', 'single' => true, 'show_in_rest' => true ) );
} );

/** Industrias en el orden elegido en el admin. */
function hanzing_industrias() {
	$terms = get_terms( array( 'taxonomy' => 'industria', 'hide_empty' => false ) );
	if ( is_wp_error( $terms ) ) {
		return array();
	}
	usort( $terms, fn( $a, $b ) => (int) get_term_meta( $a->term_id, 'orden', true ) <=> (int) get_term_meta( $b->term_id, 'orden', true ) );
	return array_map( 'hanzing_industria', $terms );
}

function hanzing_industria( $term ) {
	$lonas = get_posts( array(
		'post_type'      => 'lona',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC' ),
		'tax_query'      => array( array( 'taxonomy' => 'industria', 'terms' => $term->term_id ) ),
	) );
	return array(
		'id'      => $term->term_id,
		'nombre'  => $term->name,
		'slug'    => $term->slug,
		'url'     => get_term_link( $term ),
		'texto'   => $term->description,
		'foto_id' => (int) get_term_meta( $term->term_id, 'foto_id', true ),
		'lonas'   => array_map( 'hanzing_lona', $lonas ),
	);
}

/* ---------- Campos de la industria en el admin ---------- */

function hanzing_industria_campos( $term = null ) {
	$foto  = $term ? (int) get_term_meta( $term->term_id, 'foto_id', true ) : 0;
	$orden = $term ? (int) get_term_meta( $term->term_id, 'orden', true ) : 0;
	wp_nonce_field( 'hanzing_industria', 'hanzing_industria_nonce' );
	?>
	<div class="form-field term-foto-wrap hz-app">
		<label>Foto de la industria</label>
		<div data-hz-preview><?php echo $foto ? wp_get_attachment_image( $foto, 'medium' ) : ''; ?></div>
		<input type="hidden" name="hz_foto_id" value="<?php echo esc_attr( $foto ?: '' ); ?>" data-hz-input>
		<button type="button" class="button" data-hz-pick>Elegir foto</button>
	</div>
	<div class="form-field">
		<label for="hz_orden">Orden</label>
		<input id="hz_orden" type="number" name="hz_orden" value="<?php echo esc_attr( $orden ); ?>">
		<p class="description">Las industrias se muestran de menor a mayor.</p>
	</div>
	<script>
		( function () {
			const box = document.querySelector( '.hz-app' );
			let frame;
			box.querySelector( '[data-hz-pick]' ).addEventListener( 'click', () => {
				frame = frame || wp.media( { title: 'Foto de la industria', button: { text: 'Usar esta foto' }, multiple: false, library: { type: 'image' } } );
				frame.off( 'select' ).on( 'select', () => {
					const a = frame.state().get( 'selection' ).first().toJSON();
					box.querySelector( '[data-hz-input]' ).value = a.id;
					box.querySelector( '[data-hz-preview]' ).innerHTML = '<img src="' + a.url + '" alt="" style="max-width:240px;height:auto">';
				} );
				frame.open();
			} );
		} )();
	</script>
	<?php
}
add_action( 'industria_add_form_fields', fn() => hanzing_industria_campos() );
add_action( 'industria_edit_form_fields', function ( $term ) {
	echo '<tr><td colspan="2">';
	hanzing_industria_campos( $term );
	echo '</td></tr>';
} );
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( in_array( $hook, array( 'edit-tags.php', 'term.php' ), true ) && ( $_GET['taxonomy'] ?? '' ) === 'industria' ) {
		wp_enqueue_media();
	}
} );
$hz_save_industria = function ( $term_id ) {
	if ( ! isset( $_POST['hanzing_industria_nonce'] ) || ! wp_verify_nonce( $_POST['hanzing_industria_nonce'], 'hanzing_industria' ) ) {
		return;
	}
	update_term_meta( $term_id, 'foto_id', absint( $_POST['hz_foto_id'] ?? 0 ) );
	update_term_meta( $term_id, 'orden', (int) ( $_POST['hz_orden'] ?? 0 ) );
};
add_action( 'created_industria', $hz_save_industria );
add_action( 'edited_industria', $hz_save_industria );
