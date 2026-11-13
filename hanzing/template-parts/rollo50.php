<?php
/**
 * Más lona por tu inversión: el rollo de 50 m se mide en pantalla (regla que avanza con el scroll).
 * Pilares del manual de marca: Variedad, Costo real, Asesoría.
 */
$marcas = range( 0, 50, 5 );
?>
<section class="rollo50 section" aria-labelledby="rollo50-title">
	<div class="wrap">
		<div class="rollo50__top">
			<div class="rollo50__copy">
				<h2 id="rollo50-title" data-reveal>Más lona por tu inversión</h2>
				<p class="lead" data-reveal style="--i:1">Cada rollo FIERAFLEX trae 50 metros completos, con precio competitivo. Cuando compras por rollo, cada metro cuenta en el costo total de tu proyecto.</p>
			</div>
			<p class="rollo50__cifra" data-reveal style="--i:2" aria-label="50 metros por rollo"><span data-cuenta="50">50</span> m <small>por rollo</small></p>
		</div>
		<div class="regla" data-regla aria-hidden="true">
			<div class="regla__pista"><span class="regla__lona"></span></div>
			<ol class="regla__marcas">
				<?php foreach ( $marcas as $m ) : ?>
					<li style="--x:<?php echo (int) ( $m * 2 ); ?>%"><span><?php echo (int) $m; ?></span></li>
				<?php endforeach; ?>
			</ol>
		</div>
		<dl class="pilares">
			<div data-reveal><dt>Variedad</dt><dd>Black out, traslúcida en 24 colores, traspaulín, brincolinera, hule cristal y membrana.</dd></div>
			<div data-reveal style="--i:1"><dt>Costo real</dt><dd>Metraje, especificación, precio y flete claros desde la cotización.</dd></div>
			<div data-reveal style="--i:2"><dt>Asesoría</dt><dd>Te acompañamos a elegir el material correcto antes de comprar.</dd></div>
		</dl>
	</div>
</section>
