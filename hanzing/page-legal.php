<?php
/**
 * Template Name: Página legal
 * Términos y condiciones, política de privacidad: encabezado compacto sin foto y texto a una columna.
 */
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array( 'foto' => 0, 'compacto' => true ) );
?>
<section class="section section--tight">
	<div class="wrap legal">
		<p class="legal__fecha">Última actualización: <?php echo esc_html( get_the_modified_date( 'j \d\e F \d\e Y' ) ); ?></p>
		<div class="prose"><?php the_content(); ?></div>
	</div>
</section>
<?php
get_footer();
