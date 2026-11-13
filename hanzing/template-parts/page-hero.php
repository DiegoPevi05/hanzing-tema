<?php
/** Encabezado de página: imagen destacada o foto indicada, título y extracto. */
$foto = $args['foto'] ?? get_post_thumbnail_id();
$lead = $args['lead'] ?? ( has_excerpt() ? get_the_excerpt() : '' );
?>
<section class="page-hero<?php echo $foto ? '' : ' page-hero--plain'; ?><?php echo ! empty( $args['compacto'] ) ? ' page-hero--compact' : ''; ?>">
	<?php echo $foto ? hanzing_img( $foto, '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => '' ) ) : ''; ?>
	<?php if ( $foto ) : ?><div class="page-hero__scrim"></div><?php endif; ?>
	<div class="wrap page-hero__body">
		<nav class="crumbs" aria-label="Ruta de navegación" data-load><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a><span aria-hidden="true">/</span><span><?php the_title(); ?></span></nav>
		<h1 data-load style="--d:100ms"><?php echo esc_html( $args['titulo'] ?? get_the_title() ); ?></h1>
		<?php if ( $lead ) : ?><p class="lead" data-load style="--d:220ms"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
	</div>
</section>
