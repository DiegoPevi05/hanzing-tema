<?php
/**
 * Momento: acomodo sobre el rollo.
 * Un marcador de corte: el rollo se desenrolla y las lonas, como piezas de patrón, se acomodan sobre la lona.
 * El área de cada pieza es proporcional a su gramaje. Escritorio horizontal, teléfono vertical.
 */

$lonas = hanzing_lonas();
if ( ! $lonas ) {
	return;
}

/* Orillo impreso, como el de un rollo real. */
$orillo = str_repeat( 'FIERAFLEX   Lona de PVC   Rollo de 50 m   Grupo Hanzing      ', 6 );

/* Escritorio: dos hileras de 232 de alto; ancho = gramaje × 136 / 232. */
$escala  = 136 / 232;
$hileras = array( array(), array() );
$suma    = array( 0, 0 );
$orden   = $lonas;
usort( $orden, fn( $a, $b ) => $b['gramaje'] <=> $a['gramaje'] );
foreach ( $orden as $l ) {
	$k               = $suma[0] <= $suma[1] ? 0 : 1;
	$hileras[ $k ][] = $l;
	$suma[ $k ]     += $l['gramaje'];
}
$max_w  = 1160 - 16;
$ancho  = function ( $g ) use ( $escala, $suma, $max_w ) {
	$fit = min( 1, $max_w / ( max( $suma ) * $escala ) );
	return round( $g * $escala * $fit );
};
$desde  = array( array( -260, -120, -9 ), array( 220, -160, 8 ), array( 160, 180, -6 ), array( -200, 200, 7 ), array( 300, 40, -10 ), array( -120, -220, 5 ) );
?>
<section class="acomodo section" aria-labelledby="acomodo-title">
	<div class="wrap">
		<div class="head">
			<h2 id="acomodo-title" data-reveal>Seis lonas, cortadas de un rollo</h2>
			<p class="lead" data-reveal style="--i:1">Así se acomoda un marcador de corte en el taller: sin desperdicio. Cada pieza ocupa lo que pesa su lona; toca una para ver su ficha.</p>
		</div>

		<div class="marker" data-marker>
			<svg class="marker__svg marker__svg--wide" viewBox="0 0 1280 620" role="group" aria-labelledby="acomodo-title">
				<g class="mk-sheet">
					<rect class="mk-cloth" x="60" y="40" width="1200" height="540"/>
					<rect class="mk-selvage" x="60" y="40" width="1200" height="22"/>
					<rect class="mk-selvage" x="60" y="558" width="1200" height="22"/>
					<clipPath id="mk-orillo"><rect x="60" y="40" width="1200" height="540"/></clipPath>
					<g clip-path="url(#mk-orillo)">
						<text class="mk-selvage-text" x="72" y="56"><?php echo esc_html( $orillo ); ?></text>
						<text class="mk-selvage-text" x="72" y="574"><?php echo esc_html( $orillo ); ?></text>
					</g>
				</g>
				<g class="mk-roll" aria-hidden="true">
					<rect x="16" y="28" width="56" height="564" rx="28" fill="#c9d0dc"/>
					<rect x="26" y="28" width="16" height="564" fill="#dde2ea"/>
					<rect x="52" y="28" width="10" height="564" fill="#b4bccb"/>
				</g>
				<?php
				$i = 0;
				foreach ( $hileras as $row => $items ) {
					$x = 84;
					$y = 0 === $row ? 74 : 314;
					foreach ( $items as $l ) {
						$w = $ancho( $l['gramaje'] );
						echo hanzing_pieza( $l, $x, $y, $w, 232, $i, $desde[ $i % count( $desde ) ], 'w' ); // phpcs:ignore
						$x += $w + 8;
						$i++;
					}
					if ( $x < 1236 - 40 ) {
						echo '<g class="mk-scrap" aria-hidden="true"><rect x="' . esc_attr( $x ) . '" y="' . esc_attr( $y ) . '" width="' . esc_attr( 1236 - $x ) . '" height="232" rx="8"/><text x="' . esc_attr( $x + ( 1236 - $x ) / 2 ) . '" y="' . esc_attr( $y + 120 ) . '" transform="rotate(-90 ' . esc_attr( $x + ( 1236 - $x ) / 2 ) . ' ' . esc_attr( $y + 116 ) . ')">Retazo</text></g>';
					}
				}
				?>
			</svg>

			<?php
			/* Teléfono: el rollo arriba y las piezas en una columna, alto ∝ gramaje. */
			$alto_total = 70;
			foreach ( $lonas as $l ) {
				$alto_total += round( $l['gramaje'] * 0.3 ) + 8;
			}
			$alto_total += 20;
			?>
			<svg class="marker__svg marker__svg--tall" viewBox="0 0 400 <?php echo (int) $alto_total; ?>" role="group" aria-labelledby="acomodo-title">
				<g class="mk-sheet">
					<rect class="mk-cloth" x="28" y="40" width="344" height="<?php echo (int) ( $alto_total - 50 ); ?>"/>
					<rect class="mk-selvage" x="28" y="40" width="16" height="<?php echo (int) ( $alto_total - 50 ); ?>"/>
					<rect class="mk-selvage" x="356" y="40" width="16" height="<?php echo (int) ( $alto_total - 50 ); ?>"/>
				</g>
				<g class="mk-roll" aria-hidden="true">
					<rect x="16" y="8" width="368" height="44" rx="22" fill="#c9d0dc"/>
					<rect x="16" y="16" width="368" height="10" fill="#dde2ea"/>
					<rect x="16" y="36" width="368" height="7" fill="#b4bccb"/>
				</g>
				<?php
				$y = 68;
				foreach ( $lonas as $i => $l ) {
					$h = round( $l['gramaje'] * 0.3 );
					echo hanzing_pieza( $l, 54, $y, 292, $h, $i, array( 0, -60 - $i * 10, $i % 2 ? 4 : -4 ), 't' ); // phpcs:ignore
					$y += $h + 8;
				}
				?>
			</svg>
		</div>

		<div class="marker__cta" data-reveal>
			<p class="lead">¿No sabes cuál cortar? Te asesoramos por WhatsApp.</p>
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( 'Hola, necesito asesoría para elegir lona FIERAFLEX.' ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Pedir asesoría</a>
		</div>
	</div>
</section>
