<?php
/**
 * Panel de acciones rápidas bajo el héroe: cotizar, elegir industria y catálogo.
 */
$c = hanzing_confianza();
?>
<section class="acciones" aria-label="Acciones rápidas">
	<div class="wrap">
		<div class="acciones__panel">
			<div class="accion" data-reveal>
				<span class="accion__icon"><?php echo hanzing_icon( 'whatsapp' ); ?></span>
				<h2>Cotiza tu proyecto</h2>
				<p>Dinos qué vas a fabricar y cuántos metros necesitas. Te respondemos en horario de oficina.</p>
				<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener">Pedir cotización</a>
			</div>
			<div class="accion" data-reveal style="--i:1">
				<span class="accion__icon"><?php echo hanzing_icon( 'industria' ); ?></span>
				<h2>Elige por industria</h2>
				<p>Eventos, inflables, transporte, toldos, naves o publicidad: te decimos qué lona Fieraflex usar.</p>
				<a class="button button--field" href="<?php echo esc_url( home_url( '/industrias/' ) ); ?>">Ver industrias</a>
			</div>
			<div class="accion" data-reveal style="--i:2">
				<span class="accion__icon"><?php echo hanzing_icon( 'pdf' ); ?></span>
				<?php if ( $c['pdf'] ) : ?>
					<h2>Descarga el catálogo</h2>
					<p>Todas las lonas Fieraflex con gramaje, paso de luz y usos en un solo archivo.</p>
					<a class="button button--plain" href="<?php echo esc_url( $c['pdf'] ); ?>" download>Descargar PDF</a>
				<?php else : ?>
					<h2>Fichas técnicas</h2>
					<p>Gramaje, paso de luz, tratamientos y usos de las seis lonas Fieraflex.</p>
					<a class="button button--plain" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Ver las 6 lonas</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
