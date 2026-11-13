<?php
/**
 * Tarjeta de lona: foto de aplicación, nombre, gramaje y tres datos de ficha.
 * $args: lona (de hanzing_lona()), i (índice para el escalonado).
 */
$l      = $args['lona'];
$esp    = '';
foreach ( $l['specs'] as $sp ) {
	if ( 0 === stripos( $sp['nombre'], 'Espesor' ) ) {
		$esp = $sp['valor'];
	}
}
$datos = array_filter( array(
	'Paso de luz' => $l['luz'] ? preg_replace( '/,.*$/', '', $l['luz'] ) : '',
	'Espesor'     => $esp,
	'Uso'         => implode( ', ', array_slice( $l['usos'], 0, 2 ) ),
) );
?>
<li class="card" data-reveal style="--i:<?php echo (int) ( $args['i'] ?? 0 ) % 3; ?>">
	<a class="card__link" href="<?php echo esc_url( $l['url'] ); ?>">
		<div class="card__img"><?php echo hanzing_img( $l['aplicacion_id'], '(min-width: 1000px) 30vw, (min-width: 600px) 50vw, 100vw', array( 'alt' => $l['aplicacion_alt'] ) ); ?></div>
		<div class="card__body">
			<div class="card__title">
				<h3><?php echo esc_html( $l['nombre'] ); ?></h3>
				<span class="card__peso"><?php echo (int) $l['gramaje']; ?> g/m²</span>
			</div>
			<dl class="card__datos">
				<?php foreach ( $datos as $k => $v ) : ?>
					<div><dt><?php echo esc_html( $k ); ?></dt><dd><?php echo esc_html( $v ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
			<span class="card__mas">Ver ficha técnica <span aria-hidden="true">→</span></span>
		</div>
	</a>
</li>
