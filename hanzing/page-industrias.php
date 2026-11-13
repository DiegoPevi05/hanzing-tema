<?php
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array( 'foto' => get_post_thumbnail_id() ?: hanzing_foto_id( 'cubierta-industrial' ) ) );
?>
<section class="section" aria-label="Industrias">
	<div class="wrap">
		<?php if ( trim( get_the_content() ) ) : ?><div class="prose industrias-intro"><?php the_content(); ?></div><?php endif; ?>
		<?php get_template_part( 'template-parts/industrias-grid' ); ?>
	</div>
</section>
<?php
get_template_part( 'template-parts/contacto-banda' );
get_footer();
