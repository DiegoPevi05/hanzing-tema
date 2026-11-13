<?php
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array( 'foto' => get_post_thumbnail_id() ?: hanzing_foto_id( 'rollos-colores' ) ) );
?>
<section class="section">
	<div class="wrap prose"><?php the_content(); ?></div>
</section>
<?php
get_template_part( 'template-parts/carpa' );
get_template_part( 'template-parts/contacto-banda' );
get_footer();
