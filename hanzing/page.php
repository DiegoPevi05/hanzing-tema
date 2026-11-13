<?php
get_header();
the_post();
get_template_part( 'template-parts/page-hero' );
?>
<section class="section">
	<div class="wrap prose"><?php the_content(); ?></div>
</section>
<?php
get_template_part( 'template-parts/contacto-banda' );
get_footer();
