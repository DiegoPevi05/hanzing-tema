<?php
/**
 * Tipo de contenido "Lonas" y sus campos.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'lona', array(
		'labels'        => array(
			'name'               => 'Lonas',
			'singular_name'      => 'Lona',
			'add_new'            => 'Agregar lona',
			'add_new_item'       => 'Agregar nueva lona',
			'edit_item'          => 'Editar lona',
			'new_item'           => 'Nueva lona',
			'view_item'          => 'Ver lona',
			'search_items'       => 'Buscar lonas',
			'not_found'          => 'No hay lonas',
			'all_items'          => 'Todas las lonas',
			'featured_image'     => 'Muestra de la lona',
			'set_featured_image' => 'Elegir muestra de la lona',
		),
		'public'        => true,
		'has_archive'   => 'productos',
		'rewrite'       => array( 'slug' => 'productos', 'with_front' => false ),
		'menu_icon'     => 'dashicons-admin-site-alt3',
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'show_in_rest'  => true,
	) );

	$campos = array(
		'gramaje'        => 'integer',
		'paso_luz'       => 'string',
		'usos'           => 'string',
		'colores'        => 'string',
		'aplicacion_id'  => 'integer',
		'aplicacion_alt' => 'string',
		'especificaciones' => 'string',
		'ficha_id'       => 'integer',
		'rollo'          => 'string',
	);
	foreach ( $campos as $key => $type ) {
		register_post_meta( 'lona', $key, array(
			'type'          => $type,
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		) );
	}
} );

/** Opciones de paso de luz. */
function hanzing_pasos_luz() {
	return array(
		''            => 'Sin especificar',
		'transparente' => 'Transparente',
		'traslucida'   => 'Translúcida',
		'opaca'        => 'Opaca, bloquea la luz',
	);
}

/** Datos de una lona listos para las plantillas. */
function hanzing_lona( $post = null ) {
	$post  = get_post( $post );
	$pasos = hanzing_pasos_luz();
	$luz   = get_post_meta( $post->ID, 'paso_luz', true );
	$usos  = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $post->ID, 'usos', true ) ) ) );

	return array(
		'id'             => $post->ID,
		'nombre'         => get_the_title( $post ),
		'url'            => get_permalink( $post ),
		'gramaje'        => (int) get_post_meta( $post->ID, 'gramaje', true ),
		'luz_key'        => $luz,
		'luz'            => $luz ? $pasos[ $luz ] : '',
		'resumen'        => get_the_excerpt( $post ),
		'usos'           => $usos,
		'colores'        => get_post_meta( $post->ID, 'colores', true ) ?: 'Consulta colores disponibles',
		'muestra_id'     => get_post_thumbnail_id( $post ),
		'aplicacion_id'  => (int) get_post_meta( $post->ID, 'aplicacion_id', true ),
		'aplicacion_alt' => get_post_meta( $post->ID, 'aplicacion_alt', true ),
		'specs'          => hanzing_specs( get_post_meta( $post->ID, 'especificaciones', true ) ),
		'ficha_url'      => ( $f = (int) get_post_meta( $post->ID, 'ficha_id', true ) ) ? wp_get_attachment_url( $f ) : '',
		'rollo'          => get_post_meta( $post->ID, 'rollo', true ) ?: 'Rollo de 50 m',
	);
}

/** Convierte "Parámetro | Valor | Norma" (una línea cada uno) en filas. */
function hanzing_specs( $texto ) {
	$rows = array();
	foreach ( explode( "\n", (string) $texto ) as $line ) {
		$p = array_map( 'trim', explode( '|', $line ) );
		if ( '' !== $p[0] && isset( $p[1] ) ) {
			$rows[] = array( 'nombre' => $p[0], 'valor' => $p[1], 'norma' => $p[2] ?? '' );
		}
	}
	return $rows;
}

/** Todas las lonas en el orden del admin. */
function hanzing_lonas() {
	$posts = get_posts( array(
		'post_type'      => 'lona',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
	) );
	return array_map( 'hanzing_lona', $posts );
}

/* ---------- Caja de campos en el editor ---------- */

add_action( 'add_meta_boxes_lona', function () {
	add_meta_box( 'hanzing-lona', 'Ficha de la lona', 'hanzing_lona_metabox', 'lona', 'normal', 'high' );
} );

function hanzing_lona_metabox( $post ) {
	wp_nonce_field( 'hanzing_lona', 'hanzing_lona_nonce' );
	$v      = fn( $k ) => get_post_meta( $post->ID, $k, true );
	$app_id = (int) $v( 'aplicacion_id' );
	?>
	<style>
		.hz-fields { display: grid; gap: 14px; max-width: 760px; }
		.hz-fields label { display: grid; gap: 4px; font-weight: 600; }
		.hz-fields .description { font-weight: 400; }
		.hz-media img { max-width: 240px; height: auto; display: block; margin-bottom: 8px; border-radius: 8px; }
	</style>
	<div class="hz-fields">
		<label>Gramaje (g/m²)
			<input type="number" name="hz[gramaje]" min="1" step="1" value="<?php echo esc_attr( $v( 'gramaje' ) ); ?>" required>
		</label>
		<label>Paso de luz
			<select name="hz[paso_luz]">
				<?php foreach ( hanzing_pasos_luz() as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $v( 'paso_luz' ), $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<label>Usos (uno por línea)
			<textarea name="hz[usos]" rows="4"><?php echo esc_textarea( $v( 'usos' ) ); ?></textarea>
		</label>
		<label>Colores
			<input type="text" name="hz[colores]" value="<?php echo esc_attr( $v( 'colores' ) ); ?>" placeholder="Consulta colores disponibles">
		</label>
		<div class="hz-media" data-title="Foto de aplicación">
			<strong>Foto de aplicación</strong>
			<p class="description">La foto grande de la lona trabajando (carpa, toldo, inflable). La muestra del material va en "Muestra de la lona".</p>
			<div data-hz-preview><?php echo $app_id ? wp_get_attachment_image( $app_id, 'medium' ) : ''; ?></div>
			<input type="hidden" name="hz[aplicacion_id]" value="<?php echo esc_attr( $app_id ?: '' ); ?>" data-hz-input>
			<button type="button" class="button" data-hz-pick>Elegir foto</button>
			<button type="button" class="button-link-delete" data-hz-clear <?php echo $app_id ? '' : 'hidden'; ?>>Quitar</button>
		</div>
		<label>Descripción de la foto de aplicación (texto alternativo)
			<input type="text" name="hz[aplicacion_alt]" value="<?php echo esc_attr( $v( 'aplicacion_alt' ) ); ?>">
		</label>
		<label>Presentación del rollo
			<input type="text" name="hz[rollo]" value="<?php echo esc_attr( $v( 'rollo' ) ); ?>" placeholder="Rollo de 50 m">
		</label>
		<label>Parámetros técnicos (uno por línea: Parámetro | Valor | Norma)
			<textarea name="hz[especificaciones]" rows="8" placeholder="Espesor | 0.50 ± 0.02 mm | DIN EN ISO 2286-2"><?php echo esc_textarea( $v( 'especificaciones' ) ); ?></textarea>
		</label>
		<?php $ficha_id = (int) $v( 'ficha_id' ); ?>
		<div class="hz-media" data-title="Ficha técnica" data-type="">
			<strong>Ficha técnica para descargar (imagen o PDF)</strong>
			<div data-hz-preview><?php echo $ficha_id ? esc_html( basename( (string) wp_get_attachment_url( $ficha_id ) ) ) : ''; ?></div>
			<input type="hidden" name="hz[ficha_id]" value="<?php echo esc_attr( $ficha_id ?: '' ); ?>" data-hz-input>
			<button type="button" class="button" data-hz-pick>Elegir archivo</button>
			<button type="button" class="button-link-delete" data-hz-clear <?php echo $ficha_id ? '' : 'hidden'; ?>>Quitar</button>
		</div>
		<p class="description">El "Extracto" de la lona es la frase corta que aparece en el catálogo. El contenido del editor es la descripción larga de la ficha.</p>
	</div>
	<script>
		document.querySelectorAll( '.hz-media' ).forEach( ( box ) => {
			let frame;
			const soloImagen = box.dataset.type !== '';
			box.querySelector( '[data-hz-pick]' ).addEventListener( 'click', () => {
				frame = frame || wp.media( { title: box.dataset.title, button: { text: 'Usar este archivo' }, multiple: false, library: soloImagen ? { type: 'image' } : {} } );
				frame.off( 'select' ).on( 'select', () => {
					const a = frame.state().get( 'selection' ).first().toJSON();
					box.querySelector( '[data-hz-input]' ).value = a.id;
					const prev = box.querySelector( '[data-hz-preview]' );
					if ( a.type === 'image' ) {
						prev.innerHTML = '<img src="' + ( a.sizes && a.sizes.medium ? a.sizes.medium.url : a.url ) + '" alt="">';
					} else {
						prev.textContent = a.filename;
					}
					box.querySelector( '[data-hz-clear]' ).hidden = false;
				} );
				frame.open();
			} );
			box.querySelector( '[data-hz-clear]' ).addEventListener( 'click', ( e ) => {
				box.querySelector( '[data-hz-input]' ).value = '';
				box.querySelector( '[data-hz-preview]' ).innerHTML = '';
				e.target.hidden = true;
			} );
		} );
	</script>
	<?php
}

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) && 'lona' === get_post_type() ) {
		wp_enqueue_media();
	}
} );

add_action( 'save_post_lona', function ( $post_id ) {
	if ( ! isset( $_POST['hanzing_lona_nonce'] ) || ! wp_verify_nonce( $_POST['hanzing_lona_nonce'], 'hanzing_lona' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$in = wp_unslash( $_POST['hz'] ?? array() );
	update_post_meta( $post_id, 'gramaje', absint( $in['gramaje'] ?? 0 ) );
	update_post_meta( $post_id, 'paso_luz', array_key_exists( $in['paso_luz'] ?? '', hanzing_pasos_luz() ) ? $in['paso_luz'] : '' );
	update_post_meta( $post_id, 'usos', sanitize_textarea_field( $in['usos'] ?? '' ) );
	update_post_meta( $post_id, 'colores', sanitize_text_field( $in['colores'] ?? '' ) );
	update_post_meta( $post_id, 'aplicacion_id', absint( $in['aplicacion_id'] ?? 0 ) );
	update_post_meta( $post_id, 'aplicacion_alt', sanitize_text_field( $in['aplicacion_alt'] ?? '' ) );
	update_post_meta( $post_id, 'rollo', sanitize_text_field( $in['rollo'] ?? '' ) );
	update_post_meta( $post_id, 'especificaciones', sanitize_textarea_field( $in['especificaciones'] ?? '' ) );
	update_post_meta( $post_id, 'ficha_id', absint( $in['ficha_id'] ?? 0 ) );
} );

/* Columnas útiles en el listado del admin. */
add_filter( 'manage_lona_posts_columns', function ( $cols ) {
	$cols['gramaje']  = 'Gramaje';
	$cols['paso_luz'] = 'Paso de luz';
	return $cols;
} );
add_action( 'manage_lona_posts_custom_column', function ( $col, $id ) {
	if ( 'gramaje' === $col ) {
		echo esc_html( get_post_meta( $id, 'gramaje', true ) . ' g/m²' );
	}
	if ( 'paso_luz' === $col ) {
		$luz = get_post_meta( $id, 'paso_luz', true );
		echo esc_html( $luz ? hanzing_pasos_luz()[ $luz ] : '—' );
	}
}, 10, 2 );
