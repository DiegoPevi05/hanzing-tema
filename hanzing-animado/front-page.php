<?php
/**
 * Portada FIERAFLEX, versión animada.
 * Mismo contenido que la versión sobria, con animaciones corporativas: titular palabra por palabra,
 * cifras que cuentan, tarjetas con cortina, rollo de 50 m, capas de la lona, mapa de envíos y proceso de compra.
 * Solo azul noche, acero y naranja FIERAFLEX. Con "reducir movimiento" todo aparece en su estado final.
 */
get_header();
$lonas = hanzing_lonas();
$foto  = (int) get_theme_mod( 'hz_portada_foto1' ) ?: hanzing_foto_id( 'nave-rollos' ) ?: hanzing_foto_id( 'rollos-colores' );
$pesos = array_filter( array_column( $lonas, 'gramaje' ) );
$cifras = array(
	array( '50 m', 'por rollo, más material por tu inversión' ),
	array( $pesos ? min( $pesos ) . '–' . max( $pesos ) : '540–800', 'g/m² en ' . count( $lonas ) . ' líneas de lona de PVC' ),
	array( '24', 'colores en lona traslúcida 610' ),
	array( '1 rollo', 'es suficiente: sin pedido mínimo' ),
);
$ventajas = array(
	array( 'regla', 'Más metros por rollo', 'Rollos completos de 50 m con precio competitivo: más producto por el mismo desembolso.' ),
	array( 'envio', 'Entrega ágil a todo México', 'Envío por paquetería en convenio que reduce el costo del flete, previa revisión de cobertura.' ),
	array( 'asesoria', 'Asesoría antes de comprar', 'Te ayudamos a elegir gramaje, paso de luz y color según lo que vas a fabricar.' ),
	array( 'persona', 'Trato directo', 'Hablas con un asesor que responde casi de inmediato en horario de atención.' ),
);
$video = get_option( 'hanzing_video', array() );
?>
<section class="home-hero a-hero">
	<?php echo hanzing_img( $foto, '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => 'Nave industrial con grandes rollos de material a ambos lados' ) ); ?>
	<div class="wrap home-hero__wrap">
		<div class="panel panel--hero a-hero__panel">
			<h1 aria-label="<?php echo esc_attr( hanzing_portada( 'titulo' ) ); ?>"><span aria-hidden="true"><?php echo hanzing_animado_palabras( hanzing_portada( 'titulo' ) ); // phpcs:ignore -- escapado en la función. ?></span></h1>
			<svg class="a-hero__filete" viewBox="0 0 120 6" aria-hidden="true"><line x1="0" y1="3" x2="120" y2="3" pathLength="1"/></svg>
			<p class="lead a-hero__in" style="--d:700ms"><?php echo esc_html( hanzing_portada( 'texto' ) ); ?></p>
			<div class="actions a-hero__in" style="--d:850ms">
				<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar por WhatsApp</a>
				<a class="button button--outline" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Ver las lonas</a>
			</div>
		</div>
	</div>
</section>

<section class="cifras a-cifras" aria-label="FIERAFLEX en cifras">
	<div class="wrap">
		<dl class="cifras__list">
			<?php foreach ( $cifras as $n => $c ) : ?>
				<div data-reveal style="--i:<?php echo (int) $n; ?>"><dt><?php echo hanzing_animado_cifra( $c[0] ); // phpcs:ignore -- escapado en la función. ?></dt><dd><?php echo esc_html( $c[1] ); ?></dd></div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>

<section class="section a-cortinas" aria-labelledby="lonas-title">
	<div class="wrap">
		<div class="bar">
			<div>
				<h2 id="lonas-title" data-reveal>Lonas de PVC FIERAFLEX</h2>
				<p class="lead" data-reveal style="--i:1">Tejido de poliéster de alta resistencia con doble capa de PVC por cada lado. Anti-UV, antibacteriana y antimoho.</p>
			</div>
			<a class="arrow-link" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>" data-reveal style="--i:2">Comparar las <?php echo count( $lonas ); ?> lonas <span aria-hidden="true">→</span></a>
		</div>
		<ul class="cards">
			<?php foreach ( $lonas as $i => $l ) : ?>
				<?php get_template_part( 'template-parts/lona-card', null, array( 'lona' => $l, 'i' => $i ) ); ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/anim-regla' ); ?>

<section class="section section--field a-cortinas" aria-labelledby="industrias-title">
	<div class="wrap">
		<div class="bar">
			<div>
				<h2 id="industrias-title" data-reveal>Soluciones por industria</h2>
				<p class="lead" data-reveal style="--i:1">Cada aplicación pide una lona distinta. Elige tu sector y te mostramos las líneas recomendadas.</p>
			</div>
			<a class="arrow-link" href="<?php echo esc_url( home_url( '/industrias/' ) ); ?>" data-reveal style="--i:2">Todas las industrias <span aria-hidden="true">→</span></a>
		</div>
		<?php get_template_part( 'template-parts/industrias-grid' ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/capas' ); ?>

<?php get_template_part( 'template-parts/anim-mapa' ); ?>

<?php get_template_part( 'template-parts/anim-proceso' ); ?>

<?php get_template_part( 'template-parts/escala' ); ?>

<section class="section ventajas a-ventajas" aria-labelledby="ventajas-title">
	<div class="wrap ventajas__grid">
		<figure class="ventajas__foto a-cortina" data-anim>
			<?php if ( ! empty( $video['mp4'] ) ) : ?>
				<video muted loop playsinline preload="metadata" poster="<?php echo esc_url( wp_get_attachment_url( (int) $video['poster'] ) ); ?>" aria-hidden="true" data-autoplay>
					<source src="<?php echo esc_url( wp_get_attachment_url( (int) $video['mp4'] ) ); ?>" type="video/mp4">
				</video>
			<?php else : ?>
				<?php echo hanzing_img( hanzing_foto_id( 'equipo' ), '(min-width: 900px) 45vw, 100vw', array( 'alt' => 'Equipo de Grupo Hanzing frente a los anaqueles de rollos de lona' ) ); ?>
			<?php endif; ?>
		</figure>
		<div>
			<h2 id="ventajas-title" data-reveal>Por qué FIERAFLEX</h2>
			<p class="lead" data-reveal style="--i:1">La lona adecuada para cada proyecto, con atención que sí acompaña.</p>
			<ul class="ventajas__list">
				<?php foreach ( $ventajas as $n => $v ) : ?>
					<li data-reveal style="--i:<?php echo (int) $n; ?>">
						<span class="ventajas__icon"><?php echo hanzing_icon( $v[0] ); ?></span>
						<div><h3><?php echo esc_html( $v[1] ); ?></h3><p><?php echo esc_html( $v[2] ); ?></p></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/descargas' ); ?>

<?php get_template_part( 'template-parts/empresa' ); ?>

<?php get_template_part( 'template-parts/testimonios' ); ?>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
