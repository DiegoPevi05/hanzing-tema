<?php
/** Escala de luz con la lona actual marcada. */
$l      = $args['lona'];
$grupos = hanzing_grupos_luz();
if ( ! $l['luz_key'] || empty( $grupos[ $l['luz_key'] ] ) ) {
	return;
}
$paso = $grupos[ $l['luz_key'] ]['paso'];
$x    = ( ( $paso - 0.5 ) / 11 ) * 100;
?>
<section class="luz luz--mini section" aria-labelledby="luzmini-title">
	<div class="wrap">
		<div class="head">
			<h2 id="luzmini-title" data-reveal>Paso de luz</h2>
			<p class="lead" data-reveal style="--i:1"><?php echo esc_html( $grupos[ $l['luz_key'] ]['texto'] ); ?></p>
		</div>
		<div class="luz__ramp" aria-hidden="true">
			<?php foreach ( hanzing_rampa() as $n => $c ) : ?>
				<span style="--c:<?php echo esc_attr( $c ); ?>;--n:<?php echo (int) $n; ?>"></span>
			<?php endforeach; ?>
		</div>
		<div class="luz__pin"><span style="--x:<?php echo esc_attr( $x ); ?>%"><?php echo esc_html( $l['nombre'] ); ?></span></div>
		<div class="luz__ends"><span>Luz plena</span><span>Opaca</span></div>
	</div>
</section>
