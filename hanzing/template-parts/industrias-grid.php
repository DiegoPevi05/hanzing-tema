<?php
/**
 * Industrias en tarjetas uniformes: foto, nombre, descripción y lonas recomendadas.
 */
$industrias = $args['industrias'] ?? hanzing_industrias();
$excluir    = $args['excluir'] ?? 0;
$industrias = array_values( array_filter( $industrias, fn( $i ) => $i['id'] !== $excluir ) );
if ( ! $industrias ) {
	return;
}
?>
<ul class="sectores">
	<?php foreach ( $industrias as $n => $ind ) : ?>
		<li class="sector" data-reveal style="--i:<?php echo (int) $n % 3; ?>">
			<a href="<?php echo esc_url( $ind['url'] ); ?>">
				<div class="sector__img"><?php echo hanzing_img( $ind['foto_id'], '(min-width: 1000px) 30vw, (min-width: 600px) 50vw, 100vw', array( 'alt' => '' ) ); ?></div>
				<h3><?php echo esc_html( $ind['nombre'] ); ?></h3>
				<?php if ( $ind['texto'] ) : ?><p><?php echo esc_html( $ind['texto'] ); ?></p><?php endif; ?>
				<?php if ( $ind['lonas'] ) : ?><p class="sector__lonas"><?php echo esc_html( implode( ' · ', array_column( $ind['lonas'], 'nombre' ) ) ); ?></p><?php endif; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
