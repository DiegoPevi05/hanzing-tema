<?php
/**
 * Cómo comprar: cuatro pasos con iconos que se dibujan y una línea que los une.
 */
$pasos = array(
	array( 'Cuéntanos tu proyecto', 'Escríbenos por WhatsApp con lo que vas a fabricar y cuántos rollos necesitas.', '<path pathLength="1" d="M6 8h36v24H22l-10 8v-8H6z"/><path pathLength="1" d="M15 17h18M15 24h12"/>' ),
	array( 'Te asesoramos y cotizamos', 'Elegimos contigo gramaje, paso de luz y color. Recibes precio y flete claros.', '<path pathLength="1" d="M12 6h18l8 8v28H12z"/><path pathLength="1" d="M30 6v8h8M18 24l5 5 9-10"/>' ),
	array( 'Confirmas tu pedido', 'Desde un rollo, sin pedido mínimo. Condiciones por volumen para distribuidores.', '<path pathLength="1" d="M6 15l18-8 18 8-18 8z"/><path pathLength="1" d="M6 15v18l18 8 18-8V15M24 23v18"/>' ),
	array( 'Lo enviamos a tu ciudad', 'Paquetería en convenio a todo México, previa revisión de cobertura.', '<path pathLength="1" d="M4 12h24v20H4zM28 19h9l7 7v6H28"/><path pathLength="1" d="M13 39a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM35 39a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>' ),
);
?>
<section class="section a-proceso" aria-labelledby="proceso-title">
	<div class="wrap">
		<div class="bar">
			<div>
				<h2 id="proceso-title" data-reveal>Cómo comprar</h2>
				<p class="lead" data-reveal style="--i:1">De tu mensaje a los rollos en tu taller, en cuatro pasos.</p>
			</div>
		</div>
		<div class="a-proceso__pista" data-anim>
			<svg class="a-proceso__linea" viewBox="0 0 1000 4" preserveAspectRatio="none" aria-hidden="true"><line x1="0" y1="2" x2="1000" y2="2" pathLength="1"/></svg>
			<ol class="a-proceso__list">
				<?php foreach ( $pasos as $n => $p ) : ?>
					<li style="--n:<?php echo (int) $n; ?>">
						<span class="a-proceso__icon"><svg viewBox="0 0 48 48" aria-hidden="true" focusable="false"><?php echo $p[2]; // phpcs:ignore -- SVG fijo de esta plantilla. ?></svg></span>
						<h3><?php echo esc_html( $p[0] ); ?></h3>
						<p><?php echo esc_html( $p[1] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>
