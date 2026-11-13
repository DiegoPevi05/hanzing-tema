<?php
/**
 * Dibujo del marcador de corte (momento "acomodo sobre el rollo").
 */

defined( 'ABSPATH' ) || exit;

/** Rectángulo con esquinas de 8px y muescas de corte en V al centro de cada lado. */
function hanzing_pieza_path( $x, $y, $w, $h ) {
	$r  = 8; // radio de esquina
	$n  = 7; // medio ancho de la muesca
	$d  = 9; // profundidad de la muesca
	$mx = $x + $w / 2;
	$my = $y + $h / 2;
	$x2 = $x + $w;
	$y2 = $y + $h;
	return 'M' . ( $x + $r ) . ",$y"
		. ' H' . ( $mx - $n ) . " L$mx," . ( $y + $d ) . ' L' . ( $mx + $n ) . ",$y"
		. ' H' . ( $x2 - $r ) . " Q$x2,$y $x2," . ( $y + $r )
		. ' V' . ( $my - $n ) . ' L' . ( $x2 - $d ) . ",$my L$x2," . ( $my + $n )
		. ' V' . ( $y2 - $r ) . " Q$x2,$y2 " . ( $x2 - $r ) . ",$y2"
		. ' H' . ( $mx + $n ) . " L$mx," . ( $y2 - $d ) . ' L' . ( $mx - $n ) . ",$y2"
		. ' H' . ( $x + $r ) . " Q$x,$y2 $x," . ( $y2 - $r )
		. ' V' . ( $my + $n ) . ' L' . ( $x + $d ) . ",$my L$x," . ( $my - $n )
		. ' V' . ( $y + $r ) . " Q$x,$y " . ( $x + $r ) . ",$y Z";
}

/** Flecha de hilo (dirección del tejido). */
function hanzing_hilo( $x, $y, $len, $vertical = false ) {
	if ( $vertical ) {
		return sprintf( '<path class="mk-grain" d="M%1$s,%2$s V%3$s M%4$s,%5$s L%1$s,%2$s L%6$s,%5$s M%4$s,%7$s L%1$s,%3$s L%6$s,%7$s"/>', $x, $y, $y + $len, $x - 6, $y + 7, $x + 6, $y + $len - 7 );
	}
	return sprintf( '<path class="mk-grain" d="M%1$s,%2$s H%3$s M%4$s,%5$s L%1$s,%2$s L%4$s,%6$s M%7$s,%5$s L%3$s,%2$s L%7$s,%6$s"/>', $x, $y, $x + $len, $x + 7, $y - 6, $y + 6, $x + $len - 7 );
}

/** Una pieza enlazada con foto recortada, línea de corte, hilo y etiqueta. */
function hanzing_pieza( $l, $x, $y, $w, $h, $i, $from, $uid ) {
	$path = hanzing_pieza_path( $x, $y, $w, $h );
	$id   = "pz-$uid-$i";
	$img  = wp_get_attachment_url( $l['aplicacion_id'] ?: $l['muestra_id'] );
	$lw   = min( $w - 24, 260 );
	ob_start();
	?>
	<a class="mk-piece" href="<?php echo esc_url( $l['url'] ); ?>" aria-label="<?php echo esc_attr( 'Lona ' . $l['nombre'] . ', ' . $l['gramaje'] . ' g/m². ' . $l['resumen'] ); ?>"
		style="--dx:<?php echo esc_attr( $from[0] ); ?>px;--dy:<?php echo esc_attr( $from[1] ); ?>px;--rot:<?php echo esc_attr( $from[2] ); ?>deg;--n:<?php echo (int) $i; ?>">
		<clipPath id="<?php echo esc_attr( $id ); ?>"><path d="<?php echo esc_attr( $path ); ?>"/></clipPath>
		<g clip-path="url(#<?php echo esc_attr( $id ); ?>)">
			<?php if ( $img ) : ?>
				<image href="<?php echo esc_url( $img ); ?>" x="<?php echo esc_attr( $x ); ?>" y="<?php echo esc_attr( $y ); ?>" width="<?php echo esc_attr( $w ); ?>" height="<?php echo esc_attr( $h ); ?>" preserveAspectRatio="xMidYMid slice"/>
			<?php endif; ?>
		</g>
		<path class="mk-cut" d="<?php echo esc_attr( $path ); ?>"/>
		<circle class="mk-grain-bg" cx="<?php echo esc_attr( $x + $w - 34 ); ?>" cy="<?php echo esc_attr( $y + 34 ); ?>" r="20"/>
		<?php echo hanzing_hilo( $x + $w - 34, $y + 22, 24, true ); // phpcs:ignore ?>
		<rect class="mk-label" x="<?php echo esc_attr( $x + 12 ); ?>" y="<?php echo esc_attr( $y + $h - 72 ); ?>" width="<?php echo esc_attr( $lw ); ?>" height="60" rx="6"/>
		<text class="mk-name" x="<?php echo esc_attr( $x + 26 ); ?>" y="<?php echo esc_attr( $y + $h - 46 ); ?>"><?php echo esc_html( $l['nombre'] ); ?></text>
		<text class="mk-weight" x="<?php echo esc_attr( $x + 26 ); ?>" y="<?php echo esc_attr( $y + $h - 22 ); ?>"><?php echo esc_html( $l['gramaje'] . ' g/m²' ); ?></text>
	</a>
	<?php
	return ob_get_clean();
}

