<?php
/**
 * Carga inicial de contenido de FIERAFLEX / Grupo Hanzing.
 * Local:    php wp-cli.phar --path=wordpress eval-file hanzing-tema/semilla/seed.php
 * Servidor: wp eval-file semilla/seed.php /ruta/a/semilla/img   (lo corre el despliegue)
 * Se puede correr varias veces: actualiza en lugar de duplicar.
 */

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// eval-file no conserva __DIR__: la carpeta de imágenes llega como argumento o se busca desde la carpeta actual.
$hz_dir = ! empty( $args[0] ) ? $args[0] : '';
foreach ( array( getcwd() . '/hanzing-tema/semilla/img', getcwd() . '/semilla/img' ) as $hz_cand ) {
	if ( ! $hz_dir && is_dir( $hz_cand ) ) {
		$hz_dir = $hz_cand;
	}
}
if ( ! $hz_dir || ! is_dir( $hz_dir ) ) {
	WP_CLI::error( 'No encuentro la carpeta de imágenes de la semilla.' );
}
define( 'HZ_SEED_DIR', rtrim( $hz_dir, '/' ) );

/** Sube una imagen una sola vez y devuelve su ID. */
function hz_seed_image( $file, $alt ) {
	$slug     = 'hz-' . pathinfo( $file, PATHINFO_FILENAME );
	$existing = get_posts( array( 'post_type' => 'attachment', 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'inherit' ) );
	if ( $existing ) {
		update_post_meta( $existing[0]->ID, '_wp_attachment_image_alt', $alt );
		return $existing[0]->ID;
	}
	$tmp = wp_tempnam( $file );
	copy( HZ_SEED_DIR . "/$file", $tmp );
	$id = media_handle_sideload( array( 'name' => $file, 'tmp_name' => $tmp ), 0, null, array( 'post_name' => $slug, 'post_title' => $alt ) );
	if ( is_wp_error( $id ) ) {
		WP_CLI::warning( "$file: " . $id->get_error_message() );
		return 0;
	}
	update_post_meta( $id, '_wp_attachment_image_alt', $alt );
	return $id;
}

/** Crea o actualiza un post por slug. */
function hz_seed_post( $type, $slug, $data ) {
	$found = get_page_by_path( $slug, OBJECT, $type );
	$args  = array_merge( array( 'post_type' => $type, 'post_name' => $slug, 'post_status' => 'publish' ), $data );
	if ( $found ) {
		$args['ID'] = $found->ID;
		return wp_update_post( $args );
	}
	return wp_insert_post( $args );
}

/* ---------- Lonas ---------- */

$lonas = array(
	array(
		'slug' => 'lona-traspaulin-540', 'title' => 'Traspaulín 540', 'order' => 1, 'gramaje' => 540, 'luz' => 'transparente',
		'excerpt' => 'Lona transparente para donde hace falta ver a través.',
		'content' => 'Lona con acabado transparente para aplicaciones donde la claridad y la visibilidad son fundamentales: ventanas en carpas, cerramientos y cubiertas que no deben quitar la vista.',
		'usos' => "Ventanas para carpas\nCerramientos\nCubiertas con visibilidad", 'colores' => 'Transparente',
		'muestra' => array( 'lona-traspaulin.jpg', 'Muestra de lona Traspaulín 540' ),
		'app' => array( 'carpa-traslucida.jpg', 'Carpa con cerramientos transparentes en un jardín' ),
	),
	array(
		'slug' => 'lona-traslucida-610', 'title' => 'Traslúcida 610', 'order' => 2, 'gramaje' => 610, 'luz' => 'traslucida',
		'excerpt' => 'Deja pasar la luz de forma controlada. Disponible en varios colores.',
		'content' => 'Lona resistente e impermeable que permite el paso controlado de la luz. Multifuncional, durable y disponible en varios colores para personalizar cada proyecto, en interior o exterior.',
		'usos' => "Toldos\nCarpas\nCubiertas\nCerramientos\nPublicidad", 'colores' => 'Varios colores',
		'muestra' => array( 'lona-verde.jpg', 'Muestra de lona Traslúcida 610 en verde' ),
		'app' => array( 'toldo-terraza.jpg', 'Toldo verde sobre la terraza de un restaurante' ),
	),
	array(
		'slug' => 'lona-blackout-610', 'title' => 'Black out 610', 'order' => 3, 'gramaje' => 610, 'luz' => 'opaca',
		'excerpt' => 'La black out más versátil: publicidad, banners, fondos y cubiertas.',
		'content' => 'Lona opaca, resistente y de gran versatilidad que bloquea totalmente la luz. Funciona para múltiples proyectos en distintos sectores, en aplicaciones interiores y exteriores.',
		'usos' => "Publicidad y banners\nFondos\nCubiertas\nCarpas", 'colores' => '',
		'muestra' => array( 'lona-roja.jpg', 'Muestra de lona Black out 610 en rojo' ),
		'app' => array( 'carpa-industrial.jpg', 'Carpa industrial de lona blanca usada como almacén' ),
	),
	array(
		'slug' => 'lona-brincolinera-610', 'title' => 'Brincolinera 610', 'order' => 4, 'gramaje' => 610, 'luz' => '',
		'excerpt' => 'Hecha para brincolines, inflables y lona camionera.',
		'content' => 'Lona resistente y flexible diseñada para brincolines e inflables. Soporta fricción, peso, uso continuo y condiciones exteriores. También se usa como lona camionera.',
		'usos' => "Brincolines\nInflables\nLona camionera", 'colores' => '',
		'muestra' => array( 'brincolin.jpg', 'Brincolín inflable fabricado con lona Brincolinera 610' ),
		'app' => array( 'lona-camionera.jpg', 'Camión con caja cubierta de lona amarilla' ),
	),
	array(
		'slug' => 'lona-blackout-680', 'title' => 'Black out 680', 'order' => 5, 'gramaje' => 680, 'luz' => 'opaca',
		'excerpt' => 'Para carpas de eventos: flexible y rápida de instalar.',
		'content' => 'Lona opaca que marca la diferencia en carpas para eventos. Su flexibilidad y adaptabilidad hacen que la instalación sea sencilla y rápida.',
		'usos' => "Carpas para eventos\nVelarias\nCubiertas", 'colores' => '',
		'muestra' => array( 'lona-blanca.jpg', 'Muestra de lona Black out 680 en blanco' ),
		'app' => array( 'velaria-escuela.jpg', 'Velaria blanca tensada sobre el patio de una escuela' ),
	),
	array(
		'slug' => 'lona-blackout-800', 'title' => 'Black out 800', 'order' => 6, 'gramaje' => 800, 'luz' => 'opaca',
		'excerpt' => 'Máxima cobertura para naves avícolas y proyectos arquitectónicos.',
		'content' => 'Nuestra lona más pesada. Totalmente opaca, pensada para proyectos avícolas, arquitectónicos y cualquier aplicación que requiera máxima cobertura y resistencia a la tensión.',
		'usos' => "Naves avícolas\nProyectos arquitectónicos\nCubiertas industriales", 'colores' => '',
		'muestra' => array( 'lona-blanca.jpg', 'Muestra de lona Black out 800 en blanco' ),
		'app' => array( 'nave-agricola.jpg', 'Nave agrícola techada con lona en un campo de cultivo' ),
	),
);

foreach ( $lonas as $l ) {
	$id = hz_seed_post( 'lona', $l['slug'], array(
		'post_title'   => $l['title'],
		'post_excerpt' => $l['excerpt'],
		'post_content' => "<!-- wp:paragraph -->\n<p>{$l['content']}</p>\n<!-- /wp:paragraph -->",
		'menu_order'   => $l['order'],
	) );
	update_post_meta( $id, 'gramaje', $l['gramaje'] );
	update_post_meta( $id, 'paso_luz', $l['luz'] );
	update_post_meta( $id, 'usos', $l['usos'] );
	update_post_meta( $id, 'colores', $l['colores'] );
	set_post_thumbnail( $id, hz_seed_image( $l['muestra'][0], $l['muestra'][1] ) );
	update_post_meta( $id, 'aplicacion_id', hz_seed_image( $l['app'][0], $l['app'][1] ) );
	update_post_meta( $id, 'aplicacion_alt', $l['app'][1] );
	WP_CLI::log( "Lona: {$l['title']} ($id)" );
}

/* ---------- Fotos que usa el tema ---------- */

$fotos = array(
	'equipo'          => 'Equipo de Grupo Hanzing frente a los anaqueles de rollos de lona',
	'almacen-hanzing' => 'Almacén de Grupo Hanzing Fieraflex con camión de reparto',
	'atencion-ventas' => 'Ejecutiva de ventas de Grupo Hanzing atendiendo una llamada frente al muestrario de rollos',
	'asesor'          => 'Asesor de Grupo Hanzing en su escritorio con el muestrario de rollos al fondo',
	'rollos-colores'  => 'Rollos de lona Fieraflex de colores',
	'complementos'    => 'Rollos de lona, lona azul doblada, soplador para inflables y cinta',
	'carpa-boda'      => 'Carpa blanca montada para una boda en jardín',
	'toldo-fachada'   => 'Toldo verde sobre la entrada de un café',
	'cubierta-industrial' => 'Cubierta industrial de lona sobre un patio de maniobras',
	'cancha-techada'  => 'Cancha de pádel cubierta con lona blanca',
	'lona-traspaulin' => 'Trama de poliéster de una lona Traspaulín vista de cerca',
);
$ids = array();
foreach ( $fotos as $file => $alt ) {
	$ids[ $file ] = hz_seed_image( "$file.jpg", $alt );
}
update_option( 'hanzing_fotos', $ids );

/* ---------- Material extraído de grupohanzing.com con Scrapling ---------- */

update_option( 'hanzing_leon', hz_seed_image( 'logo-fieraflex-leon.png', 'León de Fieraflex' ) );
update_option( 'hanzing_og', hz_seed_image( 'og-fieraflex.jpg', 'Rollos de lona Fieraflex, de Grupo Hanzing' ) );
update_option( 'hanzing_video', array(
	'mp4'    => hz_seed_image( 'video-anaqueles.mp4', 'Anaqueles con rollos de lona de colores' ),
	'poster' => hz_seed_image( 'video-anaqueles-poster.jpg', 'Anaqueles con rollos de lona de colores' ),
) );

/* ---------- Logos ---------- */

$logo = hz_seed_image( 'logo-hanzing.png', 'Grupo Hanzing' );
set_theme_mod( 'custom_logo', $logo );
update_option( 'hanzing_logo_fieraflex', hz_seed_image( 'logo-fieraflex.png', 'Fieraflex' ) );

/* ---------- Páginas ---------- */

$paginas = array(
	'inicio'    => array( 'Inicio', '' ),
	'servicios' => array( 'Lona y asesoría técnica', 'Comercializamos lonas de PVC y productos complementarios pensados para durar. Cada proyecto es distinto, por eso te asesoramos antes de que compres.' ),
	'nosotros'  => array( 'Grupo Hanzing, la casa de Fieraflex', 'Una empresa mexicana de León, Guanajuato, dedicada a la venta y distribución de lonas de PVC de alta resistencia.' ),
	'contacto'  => array( 'Cotiza tu lona', 'Dinos qué lona buscas, cuántos metros y para qué proyecto. Te contestamos por WhatsApp en horario de oficina.' ),
);
$page_ids = array();
foreach ( $paginas as $slug => $p ) {
	$page_ids[ $slug ] = hz_seed_post( 'page', $slug, array( 'post_title' => $p[0], 'post_excerpt' => $p[1] ) );
}
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_ids['inicio'] );

/* Contenido editable de las páginas, si el tema lo trae. */
$patterns = get_stylesheet_directory() . '/patterns-content';
foreach ( array( 'servicios', 'nosotros', 'contacto' ) as $slug ) {
	if ( file_exists( "$patterns/$slug.html" ) ) {
		$html = str_replace( array_map( fn( $k ) => "{{foto:$k}}", array_keys( $ids ) ), array_map( 'wp_get_attachment_url', $ids ), file_get_contents( "$patterns/$slug.html" ) );
		$html = str_replace( array_map( fn( $k ) => "{{id:$k}}", array_keys( $ids ) ), array_values( $ids ), $html );
		wp_update_post( array( 'ID' => $page_ids[ $slug ], 'post_content' => $html ) );
	}
}

/* ---------- Industrias ---------- */

$industrias = array(
	'eventos'     => array( 'Eventos', 'carpa-boda.jpg', 'Carpa blanca montada para una boda', 'Carpas, velarias y cerramientos para eventos: lona opaca para sombra total y transparente para ventanas.', array( 'lona-blackout-680', 'lona-blackout-610', 'lona-traspaulin-540', 'lona-traslucida-610' ) ),
	'inflables'   => array( 'Inflables y brincolines', 'brincolin.jpg', 'Brincolín inflable', 'Lona que soporta fricción, peso y uso continuo para fabricar brincolines e inflables.', array( 'lona-brincolinera-610' ) ),
	'transporte'  => array( 'Transporte', 'lona-camionera.jpg', 'Camión con caja cubierta de lona', 'Lona camionera resistente para cubrir cajas y cargas.', array( 'lona-brincolinera-610' ) ),
	'toldos'      => array( 'Toldos y fachadas', 'toldo-fachada.jpg', 'Toldo verde en la fachada de un café', 'Toldos, cerramientos y cubiertas con luz filtrada y color.', array( 'lona-traslucida-610', 'lona-traspaulin-540' ) ),
	'naves'       => array( 'Naves y arquitectura', 'cubierta-industrial.jpg', 'Cubierta industrial de lona', 'Cubiertas industriales, naves avícolas y proyectos arquitectónicos que piden máxima cobertura.', array( 'lona-blackout-800', 'lona-blackout-680', 'lona-blackout-610' ) ),
	'publicidad'  => array( 'Publicidad', 'rollos-colores.jpg', 'Rollos de lona de colores', 'Lona para banners, fondos y anuncios, opaca o traslúcida.', array( 'lona-blackout-610', 'lona-traslucida-610' ) ),
);
$asignar = array();
$orden   = 0;
foreach ( $industrias as $slug => $d ) {
	$term = term_exists( $slug, 'industria' );
	$term = $term ? $term : wp_insert_term( $d[0], 'industria', array( 'slug' => $slug ) );
	$tid  = (int) ( is_array( $term ) ? $term['term_id'] : $term );
	wp_update_term( $tid, 'industria', array( 'name' => $d[0], 'description' => $d[3] ) );
	update_term_meta( $tid, 'foto_id', hz_seed_image( $d[1], $d[2] ) );
	update_term_meta( $tid, 'orden', ++$orden );
	foreach ( $d[4] as $lona_slug ) {
		$asignar[ $lona_slug ][] = $tid;
	}
}
foreach ( $asignar as $lona_slug => $tids ) {
	$p = get_page_by_path( $lona_slug, OBJECT, 'lona' );
	if ( $p ) {
		wp_set_object_terms( $p->ID, $tids, 'industria' );
	}
}
$page_ids['industrias'] = hz_seed_post( 'page', 'industrias', array(
	'post_title'   => 'Lona Fieraflex por industria',
	'post_excerpt' => 'Cada industria pide una lona distinta. Elige la tuya y te mostramos las líneas Fieraflex recomendadas.',
) );

/* ---------- Menú ---------- */

$menu = wp_get_nav_menu_object( 'Principal' ) ?: get_term( wp_create_nav_menu( 'Principal' ), 'nav_menu' );
foreach ( wp_get_nav_menu_items( $menu->term_id ) ?: array() as $item ) {
	wp_delete_post( $item->ID, true );
}
wp_update_nav_menu_item( $menu->term_id, 0, array( 'menu-item-title' => 'Fieraflex', 'menu-item-url' => home_url( '/productos/' ), 'menu-item-status' => 'publish', 'menu-item-type' => 'custom' ) );
wp_update_nav_menu_item( $menu->term_id, 0, array( 'menu-item-title' => 'Industrias', 'menu-item-object-id' => $page_ids['industrias'], 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
foreach ( array( 'servicios', 'nosotros', 'contacto' ) as $slug ) {
	wp_update_nav_menu_item( $menu->term_id, 0, array(
		'menu-item-title'     => array( 'servicios' => 'Servicios', 'nosotros' => 'Empresa', 'contacto' => 'Contacto' )[ $slug ],
		'menu-item-object-id' => $page_ids[ $slug ],
		'menu-item-object'    => 'page',
		'menu-item-type'      => 'post_type',
		'menu-item-status'    => 'publish',
	) );
}
set_theme_mod( 'nav_menu_locations', array( 'principal' => $menu->term_id ) );

/* ---------- Ajustes ---------- */

update_option( 'blogdescription', 'Lonas de PVC Fieraflex en León, Guanajuato' );
wp_delete_post( 1, true ); // "Hola mundo"
wp_delete_post( 2, true ); // Página de ejemplo
flush_rewrite_rules();

WP_CLI::success( 'Contenido de Hanzing cargado.' );
