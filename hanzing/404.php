<?php get_header(); ?>
<section class="page-hero page-hero--plain">
	<div class="wrap page-hero__body">
		<h1 data-load>Esta página no existe</h1>
		<p class="lead" data-load style="--d:120ms">Puede que la dirección haya cambiado con el nuevo sitio. Empieza por el catálogo o escríbenos.</p>
		<div class="hero__actions" data-load style="--d:220ms">
			<a class="button button--accent" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Ver las lonas</a>
			<a class="button button--plain" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a>
		</div>
	</div>
</section>
<?php get_footer(); ?>
