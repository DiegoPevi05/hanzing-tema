<?php
/**
 * Momento: jalar el cordón y se forma la carpa. Control accesible con teclado.
 */
$recomendada = get_page_by_path( 'lona-blackout-680', OBJECT, 'lona' );
$rec         = $recomendada ? hanzing_lona( $recomendada ) : null;
$steps       = array(
	array( 'max' => 0.02, 'text' => 'La lona está tendida en el piso. Jala el cordón para tensarla.' ),
	array( 'max' => 0.45, 'text' => 'Los postes suben y la membrana toma forma.' ),
	array( 'max' => 0.97, 'text' => 'La lona se tensa. Un buen gramaje no se deforma con la tensión.' ),
	array( 'max' => 1, 'text' => 'Carpa armada.' . ( $rec ? ' Para eventos recomendamos ' . $rec['nombre'] . ' g/m².' : '' ) ),
);
?>
<section class="carpa section" aria-labelledby="carpa-title" data-carpa data-steps="<?php echo esc_attr( wp_json_encode( $steps ) ); ?>">
	<div class="wrap">
		<div class="head">
			<h2 id="carpa-title" data-reveal>De rollo a carpa</h2>
			<p class="lead" data-reveal style="--i:1">Así trabaja una lona Fieraflex: plana en el rollo, tensa en la estructura. Jala el cordón.</p>
		</div>
		<div class="carpa__stage">
			<div class="carpa__figure" data-reveal>
				<svg class="carpa__svg" viewBox="0 0 800 420" role="img" aria-label="Lona que pasa de estar tendida en el piso a formar una carpa">
					<rect class="carpa__ground" x="0" y="372" width="800" height="48" rx="8"/>
					<ellipse class="carpa__shadow" cx="400" cy="378" rx="300" ry="4"/>
					<line class="carpa__guy" data-guy="l" x1="170" y1="372" x2="80" y2="372"/>
					<line class="carpa__guy" data-guy="r" x1="630" y1="372" x2="720" y2="372"/>
					<path class="carpa__stake" d="M76,366 L80,384 L84,366 M716,366 L720,384 L724,366 M756,358 L760,384 L764,358"/>
					<line class="carpa__pole" data-pole="l" x1="170" y1="372" x2="170" y2="372"/>
					<line class="carpa__pole" data-pole="c" x1="400" y1="372" x2="400" y2="372"/>
					<line class="carpa__pole" data-pole="r" x1="630" y1="372" x2="630" y2="372"/>
					<path class="carpa__sheet" d="M90,368 L710,368 Z"/>
					<path class="carpa__seam" d="M400,364 L400,364"/>
					<path class="carpa__cord" d="M400,364 Q580,380 760,360"/>
					<circle class="carpa__pulley" cx="760" cy="360" r="9"/>
				</svg>
			</div>
			<div class="carpa__control">
				<label for="carpa-range">Cordón</label>
				<input id="carpa-range" class="carpa__range" type="range" min="0" max="100" value="0" step="1" aria-describedby="carpa-status">
				<p id="carpa-status" class="carpa__status" aria-live="polite">La lona está tendida en el piso. Jala el cordón para tensarla.</p>
				<div class="carpa__done">
					<?php if ( $rec ) : ?>
						<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( 'Hola, quiero cotizar Lona ' . $rec['nombre'] . ' g/m² Fieraflex para una carpa.' ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar <?php echo esc_html( $rec['nombre'] ); ?></a>
						<a class="link" href="<?php echo esc_url( $rec['url'] ); ?>">Ver ficha</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
