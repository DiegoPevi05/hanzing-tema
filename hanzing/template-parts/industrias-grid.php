<?php
/**
 * Mosaico de industrias. Las dos primeras van grandes; el resto, en la fila de abajo.
 */
$industrias = $args['industrias'] ?? hanzing_industrias();
$excluir    = $args['excluir'] ?? 0;
$industrias = array_values( array_filter( $industrias, fn( $i ) => $i['id'] !== $excluir ) );
if ( ! $industrias ) {
	return;
}
?>
<ul class="industrias<?php echo count( $industrias ) < 6 ? ' industrias--compacta' : ''; ?>">
	<?php foreach ( $industrias as $n => $ind ) : ?>
		<li class="industria" data-reveal style="--i:<?php echo (int) $n % 4; ?>">
			<a href="<?php echo esc_url( $ind['url'] ); ?>">
				<?php echo hanzing_img( $ind['foto_id'], $n < 2 ? '(min-width: 900px) 50vw, 100vw' : '(min-width: 900px) 25vw, 50vw', array( 'alt' => '' ) ); ?>
				<span class="industria__label">
					<strong><?php echo esc_html( $ind['nombre'] ); ?></strong>
					<?php if ( $ind['lonas'] ) : ?>
						<span><?php echo esc_html( implode( ', ', array_column( $ind['lonas'], 'nombre' ) ) ); ?></span>
					<?php endif; ?>
				</span>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
