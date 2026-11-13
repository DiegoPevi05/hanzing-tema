<?php
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array( 'foto' => get_post_thumbnail_id() ?: hanzing_foto_id( 'almacen-hanzing' ) ) );
?>
<section class="section">
	<div class="wrap prose"><?php the_content(); ?></div>
</section>
<?php get_template_part( 'template-parts/equipo' ); ?>
<?php $yt = hanzing_contacto( 'youtube_id' ); ?>
<?php if ( $yt ) : ?>
<section class="section section--steel" aria-labelledby="video-title">
	<div class="wrap">
		<div class="head">
			<h2 id="video-title" data-reveal>Míranos trabajar</h2>
			<p class="lead" data-reveal style="--i:1">Más videos de producto y aplicaciones en <a class="link" href="<?php echo esc_url( hanzing_contacto( 'youtube' ) ); ?>" target="_blank" rel="noopener">nuestro canal de YouTube</a>.</p>
		</div>
		<div class="yt" data-yt="<?php echo esc_attr( $yt ); ?>" data-reveal>
			<button type="button" class="yt__btn" aria-label="Reproducir video de Lonas Fieraflex">
				<img src="<?php echo esc_url( "https://i.ytimg.com/vi/$yt/hqdefault.jpg" ); ?>" alt="" width="480" height="360" loading="lazy">
				<span class="yt__play"><?php echo hanzing_icon( 'play' ); ?></span>
			</button>
		</div>
	</div>
</section>
<?php endif; ?>
<?php
get_template_part( 'template-parts/contacto-banda' );
get_footer();
