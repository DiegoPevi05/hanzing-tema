<?php
/**
 * Testimonios reales cargados en el admin. Sin testimonios, la sección no aparece.
 */
$items = hanzing_testimonios();
if ( ! $items ) {
	return;
}
?>
<section class="section testimonios" aria-labelledby="testimonios-title">
	<div class="wrap">
		<div class="head">
			<h2 id="testimonios-title" data-reveal>Lo que dicen nuestros clientes</h2>
		</div>
		<ul class="testimonios__list">
			<?php foreach ( $items as $n => $t ) : ?>
				<li data-reveal style="--i:<?php echo (int) $n % 3; ?>">
					<figure>
						<blockquote><?php echo wp_kses_post( wpautop( $t->post_content ) ); ?></blockquote>
						<figcaption><strong><?php echo esc_html( get_the_title( $t ) ); ?></strong><?php $e = get_post_meta( $t->ID, 'empresa', true ); echo $e ? '<span>' . esc_html( $e ) . '</span>' : ''; ?></figcaption>
					</figure>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
