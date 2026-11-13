<?php
/**
 * Panel de pruebas bajo el héroe: las cuatro razones comerciales de FIERAFLEX (correo del cliente, nov. 2026).
 */
$c      = hanzing_confianza();
$puntos = array(
	array( 'regla', 'Rollos de 50 metros', 'Más material por el mismo desembolso.' ),
	array( 'cajas', 'Sin pedido mínimo', 'Desde un rollo hasta volumen de distribuidor.' ),
	array( 'envio', $c['envios'] ?: 'Envíos a todo México', 'Con paquetería en convenio, previa revisión de cobertura.' ),
	array( 'reloj', 'Respuesta rápida', 'Contestamos casi de inmediato en horario de atención.' ),
);
?>
<section class="acciones" aria-label="Por qué FIERAFLEX">
	<div class="wrap">
		<ul class="acciones__panel">
			<?php foreach ( $puntos as $n => $p ) : ?>
				<li class="accion" data-reveal style="--i:<?php echo (int) $n; ?>">
					<span class="accion__icon"><?php echo hanzing_icon( $p[0] ); ?></span>
					<h2><?php echo esc_html( $p[1] ); ?></h2>
					<p><?php echo esc_html( $p[2] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
