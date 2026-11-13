<?php
/**
 * Tema Hanzing.
 */

defined( 'ABSPATH' ) || exit;

define( 'HANZING_VERSION', '1.0.0' );

require __DIR__ . '/inc/helpers.php';
require __DIR__ . '/inc/lonas.php';
require __DIR__ . '/inc/contacto.php';
require __DIR__ . '/inc/portada.php';
require __DIR__ . '/inc/marker.php';
require __DIR__ . '/inc/industrias.php';
require __DIR__ . '/inc/testimonios.php';
require __DIR__ . '/inc/medicion.php';
require __DIR__ . '/inc/otros.php';
require __DIR__ . '/inc/reclamos.php';

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_editor_style( array( 'assets/css/fonts.css', 'assets/css/editor.css' ) );
	register_nav_menus( array( 'principal' => 'Menú principal' ) );
	add_post_type_support( 'page', 'excerpt' );
} );

add_action( 'wp_enqueue_scripts', function () {
	$uri = get_template_directory_uri();
	$dir = get_template_directory();
	wp_enqueue_style( 'hanzing-fonts', "$uri/assets/css/fonts.css", array(), filemtime( "$dir/assets/css/fonts.css" ) );
	wp_enqueue_style( 'hanzing', "$uri/assets/css/main.css", array(), filemtime( "$dir/assets/css/main.css" ) );
	wp_enqueue_script( 'hanzing', "$uri/assets/js/main.js", array(), filemtime( "$dir/assets/js/main.js" ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	// El tema no usa los estilos de bloques de comentarios ni emojis.
	wp_dequeue_style( 'classic-theme-styles' );
} );

add_action( 'wp_head', function () {
	echo "<script>document.documentElement.classList.add('js')</script>\n";
	echo '<link rel="preload" href="' . esc_url( get_template_directory_uri() . '/assets/fonts/source-sans-3-latin-wght-normal.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
	echo '<meta name="theme-color" content="#ffffff">' . "\n";
}, 1 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* Open Graph: título, descripción e imagen al compartir en WhatsApp y redes. */
add_action( 'wp_head', function () {
	$titulo = wp_get_document_title();
	$desc   = is_singular() && has_excerpt() ? get_the_excerpt() : get_bloginfo( 'description' );
	if ( is_front_page() ) {
		$desc = hanzing_portada( 'texto' );
	}
	$img = is_singular() && has_post_thumbnail() && ! is_page() ? get_the_post_thumbnail_url( null, 'full' ) : wp_get_attachment_url( (int) get_option( 'hanzing_og' ) );
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_strip_all_tags( $desc ) ) );
	printf( '<meta property="og:type" content="website"><meta property="og:locale" content="es_MX"><meta property="og:site_name" content="FIERAFLEX">' . "\n" );
	printf( '<meta property="og:title" content="%s"><meta property="og:description" content="%s"><meta property="og:url" content="%s">' . "\n", esc_attr( $titulo ), esc_attr( wp_strip_all_tags( $desc ) ), esc_url( home_url( add_query_arg( array() ) ) ) );
	if ( $img ) {
		printf( '<meta property="og:image" content="%s"><meta name="twitter:card" content="summary_large_image">' . "\n", esc_url( $img ) );
	}
}, 5 );

/* Datos estructurados del negocio. */
add_action( 'wp_head', function () {
	$data = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'Store',
		'name'      => 'FIERAFLEX · Grupo Hanzing',
		'url'       => home_url( '/' ),
		'telephone' => '+52 ' . hanzing_contacto( 'telefono' ),
		'email'     => hanzing_contacto( 'email' ),
		// Sin calle ni número: solo ciudad, por seguridad del almacén.
		'address'   => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'León',
			'addressRegion'   => 'Guanajuato',
			'addressCountry'  => 'MX',
		),
		'areaServed' => 'MX',
		'sameAs'    => array_filter( array( hanzing_contacto( 'facebook' ), hanzing_contacto( 'instagram' ), hanzing_contacto( 'youtube' ) ) ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "</script>\n";
} );

/* El archivo de lonas muestra todas, en el orden del admin. */
add_action( 'pre_get_posts', function ( WP_Query $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_post_type_archive( 'lona' ) ) {
		$q->set( 'posts_per_page', -1 );
		$q->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}
} );

/* Títulos de documento con la marca. */
add_filter( 'document_title_separator', fn() => '|' );
