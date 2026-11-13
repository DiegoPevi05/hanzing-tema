<?php
get_header();
$lonas = hanzing_lonas();
$fotos = array_values( array_filter( array( get_theme_mod( 'hz_portada_foto1' ) ?: hanzing_foto_id( 'almacen-hanzing' ) ) ) );
?>
<section class="corp-hero">
	<?php echo hanzing_img( (int) $fotos[0], '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => 'Almacén de Grupo Hanzing con camión de reparto y tarimas de rollos de lona Fieraflex' ) ); ?>
	<div class="corp-hero__scrim"></div>
	<div class="wrap corp-hero__body">
		<h1 data-load style="--d:80ms"><?php echo esc_html( hanzing_portada( 'titulo' ) ); ?></h1>
		<p class="lead" data-load style="--d:200ms"><?php echo esc_html( hanzing_portada( 'texto' ) ); ?></p>
		<div class="hero__actions" data-load style="--d:300ms">
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar por WhatsApp</a>
			<a class="button button--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Conocer Fieraflex</a>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/acciones' ); ?>

<section class="section" aria-labelledby="industrias-title">
	<div class="wrap">
		<div class="head">
			<h2 id="industrias-title" data-reveal>Soluciones por industria</h2>
			<p class="lead" data-reveal style="--i:1">Cada aplicación pide una lona distinta. Elige la tuya y te mostramos las líneas Fieraflex recomendadas.</p>
		</div>
		<?php get_template_part( 'template-parts/industrias-grid' ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/fieraflex' ); ?>

<section class="section" aria-labelledby="catalogo-title">
	<div class="wrap">
		<div class="head">
			<h2 id="catalogo-title" data-reveal>Las seis lonas Fieraflex</h2>
			<p class="lead" data-reveal style="--i:1">PVC con refuerzo de poliéster de alta tenacidad, impermeable, con protección UV y antimoho. Elige por gramaje y por cuánta luz necesitas.</p>
		</div>
		<ul class="lonas-list">
			<?php foreach ( $lonas as $i => $l ) : ?>
				<li class="lona-item" data-reveal style="--i:<?php echo (int) $i % 3; ?>">
					<a href="<?php echo esc_url( $l['url'] ); ?>">
						<div class="lona-item__img"><?php echo hanzing_img( $l['aplicacion_id'], '(min-width: 900px) 33vw, 100vw', array( 'alt' => $l['aplicacion_alt'] ) ); ?></div>
						<div class="lona-item__line"><span class="lona-item__name"><?php echo esc_html( $l['nombre'] ); ?></span><span class="lona-item__weight"><?php echo (int) $l['gramaje']; ?> g/m²</span></div>
						<p class="lona-item__desc"><?php echo esc_html( $l['resumen'] ); ?></p>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/confianza' ); ?>

<?php get_template_part( 'template-parts/luz' ); ?>

<?php get_template_part( 'template-parts/empresa' ); ?>

<?php get_template_part( 'template-parts/testimonios' ); ?>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
