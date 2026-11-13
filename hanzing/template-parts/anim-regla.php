<?php
/**
 * Rollo de 50 m: el rollo avanza sobre la regla y deja la lona extendida mientras el contador sube.
 */
?>
<section class="section section--steel a-regla" aria-labelledby="regla-title">
	<div class="wrap">
		<div class="a-regla__top">
			<div class="a-regla__copy">
				<h2 id="regla-title" data-reveal>50 metros completos por rollo</h2>
				<p class="lead" data-reveal style="--i:1">Más material por el mismo desembolso. Cuando compras por rollo, cada metro cuenta en el costo total de tu proyecto.</p>
			</div>
			<p class="a-regla__cifra" aria-label="50 metros por rollo"><span data-cuenta="50">50</span> m</p>
		</div>
		<svg class="a-regla__svg" viewBox="0 0 1200 190" role="img" aria-label="Un rollo de lona se desenrolla sobre una regla de 0 a 50 metros" data-anim>
			<rect class="a-regla__pista" x="50" y="92" width="1100" height="20" rx="2"/>
			<rect class="a-regla__lona" x="50" y="92" width="1100" height="20" rx="2"/>
			<g class="a-regla__rollo">
				<g class="a-regla__giro">
					<circle cx="50" cy="74" r="40"/>
					<circle class="a-regla__nucleo" cx="50" cy="74" r="13"/>
					<path class="a-regla__vuelta" d="M50 46a28 28 0 0 1 28 28M50 102a28 28 0 0 1-28-28"/>
				</g>
			</g>
			<g class="a-regla__marcas">
				<?php for ( $m = 0; $m <= 50; $m += 5 ) : $x = 50 + $m * 22; ?>
					<g style="--m:<?php echo (int) $m; ?>"><line x1="<?php echo (int) $x; ?>" y1="124" x2="<?php echo (int) $x; ?>" y2="<?php echo 0 === $m % 10 ? 140 : 134; ?>"/><?php if ( 0 === $m % 10 ) : ?><text x="<?php echo (int) $x; ?>" y="166" text-anchor="middle"><?php echo (int) $m; ?> m</text><?php endif; ?></g>
				<?php endfor; ?>
			</g>
		</svg>
	</div>
</section>
