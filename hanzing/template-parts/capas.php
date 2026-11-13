<?php
/**
 * Así está hecha la lona: corte en capas que se separa al entrar en pantalla (vista explotada).
 * Datos de las fichas técnicas FIERAFLEX (Black out 610/680/800 y Laminada 610).
 */
$capas = array(
	array( 'PVC de alto peso molecular', '2.ª capa exterior' ),
	array( 'PVC de alto peso molecular', '1.ª capa' ),
	array( 'Tejido base de alta resistencia', 'Poliéster 1000D, 14×14' ),
	array( 'PVC de alto peso molecular', '1.ª capa' ),
	array( 'PVC de alto peso molecular', '2.ª capa exterior' ),
);
$datos = $args['datos'] ?? array(
	array( '≥ 2,500', 'N/5 cm', 'Tracción a lo largo' ),
	array( '≥ 230', 'N', 'Fuerza de desgarro' ),
	array( '−30 a 70', '°C', 'Temperatura de uso' ),
);
?>
<section class="capas section section--steel" aria-labelledby="capas-title">
	<div class="wrap capas__grid">
		<div class="capas__copy">
			<h2 id="capas-title" data-reveal>Así está hecha una lona FIERAFLEX</h2>
			<p class="lead" data-reveal style="--i:1">Tejido de poliéster de alta resistencia con dos capas de PVC por cada lado. Anti-UV, antibacteriana y antimoho.</p>
			<dl class="capas__datos">
				<?php foreach ( $datos as $n => $d ) : ?>
					<div data-reveal style="--i:<?php echo (int) $n + 2; ?>"><dt><?php echo esc_html( $d[2] ); ?></dt><dd><strong><?php echo esc_html( $d[0] ); ?></strong> <?php echo esc_html( $d[1] ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
		</div>
		<figure class="capas__fig" data-capas>
			<ol class="capas__pila">
				<?php foreach ( $capas as $n => $c ) : ?>
					<li class="capa capa--<?php echo 2 === $n ? 'tejido' : 'pvc'; ?>" style="--n:<?php echo (int) ( $n - 2 ); ?>">
						<span class="capa__lamina" aria-hidden="true"></span>
						<span class="capa__txt"><strong><?php echo esc_html( $c[0] ); ?></strong> <?php echo esc_html( $c[1] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
			<figcaption>Corte de la lona: dos capas de PVC a cada lado del tejido base.</figcaption>
		</figure>
	</div>
</section>
