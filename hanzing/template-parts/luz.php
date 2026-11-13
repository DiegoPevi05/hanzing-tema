<?php
/**
 * Momento: escala de paso de luz. Elegir un tipo de lona oscurece la foto como lo haría la lona.
 */
$grupos = hanzing_grupos_luz();
$lonas  = hanzing_lonas();
$por    = array();
foreach ( $lonas as $l ) {
	if ( $l['luz_key'] ) {
		$por[ $l['luz_key'] ][] = $l;
	}
}
$links = function ( $key ) use ( $por ) {
	$out = array();
	foreach ( $por[ $key ] ?? array() as $l ) {
		$out[] = '<a class="link" href="' . esc_url( $l['url'] ) . '">' . esc_html( $l['nombre'] ) . '</a>';
	}
	return implode( '', $out );
};
$inicial = 'traslucida';
$g0      = $grupos[ $inicial ];
?>
<section class="luz section" aria-labelledby="luz-title" data-luz>
	<div class="wrap">
		<div class="head">
			<h2 id="luz-title" data-reveal>¿Cuánta luz pasa?</h2>
			<p class="lead" data-reveal style="--i:1">Cada lona FIERAFLEX deja pasar más o menos luz. Elige un tipo y mira cómo se vería el cielo debajo.</p>
		</div>

		<p class="luz__note">Escala ilustrativa, de luz plena a opaca.</p>
		<div class="luz__ramp" aria-hidden="true">
			<?php foreach ( hanzing_rampa() as $n => $c ) : ?>
				<span style="--c:<?php echo esc_attr( $c ); ?>;--n:<?php echo (int) $n; ?>"></span>
			<?php endforeach; ?>
		</div>

		<div class="luz__choices" role="group" aria-label="Tipo de lona por paso de luz">
			<?php foreach ( $grupos as $key => $g ) : ?>
				<button type="button" class="luz__choice" aria-pressed="<?php echo $key === $inicial ? 'true' : 'false'; ?>"
					data-opacity="<?php echo esc_attr( $g['opacidad'] ); ?>"
					data-color="<?php echo esc_attr( $g['color'] ); ?>"
					data-pct="<?php echo esc_attr( $g['pct'] ); ?>"
					data-text="<?php echo esc_attr( $g['texto'] ); ?>"
					data-lonas="<?php echo esc_attr( $links( $key ) ); ?>">
					<strong><?php echo esc_html( $g['nombre'] ); ?></strong>
					<span><?php echo count( $por[ $key ] ?? array() ); ?> <?php echo 1 === count( $por[ $key ] ?? array() ) ? 'lona' : 'lonas'; ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="luz__demo">
			<div class="luz__window" data-reveal>
				<?php echo hanzing_img( hanzing_foto_id( 'carpa-boda' ), '(min-width: 900px) 58vw, 100vw', array( 'alt' => 'Vista de una carpa desde adentro, con el cielo detrás de la lona' ) ); ?>
				<div class="luz__sheet" style="--o:<?php echo esc_attr( $g0['opacidad'] ); ?>;--sheet:<?php echo esc_attr( $g0['color'] ); ?>"></div>
			</div>
			<div class="luz__readout" aria-live="polite" data-reveal style="--i:1">
				<div class="luz__pct" data-luz-pct><?php echo esc_html( $g0['pct'] ); ?></div>
				<p data-luz-text><?php echo esc_html( $g0['texto'] ); ?></p>
				<div class="luz__lonas" data-luz-lonas><?php echo $links( $inicial ); // phpcs:ignore ?></div>
			</div>
		</div>
	</div>
</section>
