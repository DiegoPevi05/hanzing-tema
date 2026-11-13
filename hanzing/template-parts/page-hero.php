<?php
/**
 * Encabezado de página interior: foto a sangre con panel azul noche abajo a la izquierda.
 * $args: foto, titulo, lead, compacto, crumbs (array de [texto, url]), extra (HTML ya escapado).
 */
$foto   = $args['foto'] ?? get_post_thumbnail_id();
$lead   = $args['lead'] ?? ( has_excerpt() ? get_the_excerpt() : '' );
$crumbs = $args['crumbs'] ?? array();
?>
<section class="page-hero<?php echo ! empty( $args['compacto'] ) ? ' page-hero--compact' : ''; ?>">
	<?php echo $foto ? hanzing_img( $foto, '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => $args['alt'] ?? '' ) ) : ''; ?>
	<div class="wrap page-hero__wrap">
		<div class="panel" data-load>
			<nav class="crumbs" aria-label="Ruta de navegación"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a><?php foreach ( $crumbs as $c ) : ?><span aria-hidden="true">/</span><a href="<?php echo esc_url( $c[1] ); ?>"><?php echo esc_html( $c[0] ); ?></a><?php endforeach; ?></nav>
			<h1><?php echo esc_html( $args['titulo'] ?? get_the_title() ); ?></h1>
			<?php if ( $lead ) : ?><p class="lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
			<?php echo $args['extra'] ?? ''; // phpcs:ignore -- HTML armado por la plantilla que llama. ?>
		</div>
	</div>
</section>
