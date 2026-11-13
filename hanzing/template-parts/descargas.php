<?php
/**
 * Centro de fichas técnicas (descargas) junto a "También surtimos".
 */
$lonas = hanzing_lonas();
$c     = hanzing_confianza();
$otros = hanzing_otros();
?>
<section class="section section--field descargas" aria-labelledby="descargas-title">
	<div class="wrap descargas__grid">
		<div>
			<h2 id="descargas-title" data-reveal>Fichas técnicas</h2>
			<p class="lead" data-reveal style="--i:1">Gramaje, espesor, tracción, desgarro y temperatura de uso de cada lona, listos para descargar.</p>
			<ul class="docs">
				<?php if ( $c['pdf'] ) : ?>
					<li data-reveal><a href="<?php echo esc_url( $c['pdf'] ); ?>" download><?php echo hanzing_icon( 'pdf' ); ?><span><strong>Catálogo FIERAFLEX</strong><small>PDF</small></span><em>Descargar</em></a></li>
				<?php endif; ?>
				<?php foreach ( $lonas as $n => $l ) : ?>
					<li data-reveal style="--i:<?php echo (int) $n % 3; ?>">
						<?php if ( $l['ficha_url'] ) : ?>
							<a href="<?php echo esc_url( $l['ficha_url'] ); ?>" target="_blank" rel="noopener" download><?php echo hanzing_icon( 'pdf' ); ?><span><strong>Lona <?php echo esc_html( $l['nombre'] ); ?></strong><small><?php echo (int) $l['gramaje']; ?> g/m² · Ficha técnica</small></span><em>Descargar</em></a>
						<?php else : ?>
							<a href="<?php echo esc_url( hanzing_whatsapp( 'Hola, me pueden enviar la ficha técnica de la Lona ' . $l['nombre'] . ' FIERAFLEX?' ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'pdf' ); ?><span><strong>Lona <?php echo esc_html( $l['nombre'] ); ?></strong><small><?php echo (int) $l['gramaje']; ?> g/m² · Bajo solicitud</small></span><em>Solicitar</em></a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php if ( $otros ) : ?>
			<div>
				<h2 id="otros-title" data-reveal>También surtimos</h2>
				<p class="lead" data-reveal style="--i:1">Otros rollos y accesorios para completar tu pedido en un solo envío.</p>
				<ul class="docs docs--otros">
					<?php foreach ( $otros as $n => $o ) : ?>
						<li data-reveal style="--i:<?php echo (int) $n % 3; ?>"><a href="<?php echo esc_url( hanzing_whatsapp( 'Hola, quiero cotizar ' . $o[0] . ' FIERAFLEX.' ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'rollos' ); ?><span><strong><?php echo esc_html( $o[0] ); ?></strong><?php if ( $o[1] ) : ?><small><?php echo esc_html( $o[1] ); ?></small><?php endif; ?></span><em>Cotizar</em></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>
