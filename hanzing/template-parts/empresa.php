<?php
/**
 * Respaldo de Grupo Hanzing (marca matriz). Valores del manual de marca 2026.
 */
$hz = get_theme_mod( 'custom_logo' );
?>
<section class="empresa section" aria-labelledby="empresa-title">
	<div class="wrap">
		<div class="empresa__grid">
			<div class="empresa__body">
				<?php echo $hz ? wp_get_attachment_image( $hz, 'full', false, array( 'class' => 'empresa__logo', 'alt' => 'Grupo Hanzing', 'loading' => 'lazy', 'sizes' => '140px' ) ) : ''; ?>
				<h2 id="empresa-title" data-reveal>Con el respaldo de Grupo Hanzing</h2>
				<p class="lead" data-reveal style="--i:1">FIERAFLEX es la marca de lonas de PVC de Grupo Hanzing, el grupo empresarial mexicano que articula la operación, las relaciones comerciales y el crecimiento de sus marcas.</p>
				<dl class="empresa__pillars">
					<div data-reveal style="--i:1"><dt>Solidez</dt><dd>Procesos claros, cumplimiento y consistencia.</dd></div>
					<div data-reveal style="--i:2"><dt>Confianza</dt><dd>Transparencia en acuerdos, precios y compromisos.</dd></div>
					<div data-reveal style="--i:3"><dt>Visión</dt><dd>Desarrollo de mercado y crecimiento ordenado.</dd></div>
					<div data-reveal style="--i:4"><dt>Cercanía</dt><dd>Relaciones comerciales directas y profesionales.</dd></div>
				</dl>
				<a class="button button--field" href="<?php echo esc_url( home_url( '/nosotros/' ) ); ?>" data-reveal style="--i:5">Conocer Grupo Hanzing</a>
			</div>
			<figure class="empresa__photo" data-reveal>
				<?php echo hanzing_img( hanzing_foto_id( 'atencion-ventas' ), '(min-width: 900px) 50vw, 100vw', array( 'alt' => 'Ejecutiva de ventas de Grupo Hanzing atendiendo una llamada frente al muestrario de rollos' ) ); ?>
			</figure>
		</div>
	</div>
</section>
