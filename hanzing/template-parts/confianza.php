<?php
/**
 * Nuestro compromiso: solo datos reales (el año y los envíos salen de Personalizar › Empresa y confianza).
 */
$c     = hanzing_confianza();
$items = array_values( array_filter( array(
	$c['anio'] ? array( 'calendario', 'Desde ' . $c['anio'], 'Grupo Hanzing, empresa mexicana' ) : null,
	array( 'rollos', 'Stock disponible', 'Rollos FIERAFLEX listos para surtir tu pedido' ),
	array( 'reloj', 'Entrega ágil', 'Tiempos de entrega rápidos y envío por paquetería' ),
	array( 'asesoria', 'Asesoría técnica', 'Diagnóstico y seguimiento para elegir bien' ),
	array( 'persona', 'Trato directo', 'Hablas con un asesor, no con un conmutador' ),
) ) );
?>
<section class="compromiso section section--steel" aria-labelledby="compromiso-title">
	<div class="wrap">
		<div class="head">
			<h2 id="compromiso-title" data-reveal>Nuestro compromiso</h2>
			<p class="lead" data-reveal style="--i:1">La lona adecuada para cada proyecto, con atención que sí acompaña.</p>
		</div>
		<?php $v = get_option( 'hanzing_video', array() ); ?>
		<div class="compromiso__grid<?php echo empty( $v['mp4'] ) ? ' compromiso__grid--solo' : ''; ?>">
		<?php if ( ! empty( $v['mp4'] ) ) : ?>
			<figure class="compromiso__video" data-reveal>
				<video muted loop playsinline preload="metadata" poster="<?php echo esc_url( wp_get_attachment_url( (int) $v['poster'] ) ); ?>" aria-hidden="true" data-autoplay>
					<source src="<?php echo esc_url( wp_get_attachment_url( (int) $v['mp4'] ) ); ?>" type="video/mp4">
				</video>
			</figure>
		<?php endif; ?>
		<ul class="compromiso__list">
			<?php foreach ( $items as $n => $it ) : ?>
				<li data-reveal style="--i:<?php echo (int) $n; ?>">
					<span class="compromiso__icon"><?php echo hanzing_icon( $it[0] ); ?></span>
					<strong><?php echo esc_html( $it[1] ); ?></strong>
					<span><?php echo esc_html( $it[2] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		</div>
	</div>
</section>
