<?php
/**
 * Otros rollos y accesorios FIERAFLEX.
 */
$otros = hanzing_otros();
if ( ! $otros ) {
	return;
}
?>
<section class="otros section section--steel" aria-labelledby="otros-title">
	<div class="wrap otros__grid">
		<div class="otros__copy">
			<h2 id="otros-title" data-reveal>También surtimos</h2>
			<p class="lead" data-reveal style="--i:1">Otros rollos y accesorios para completar tu pedido en un solo envío.</p>
			<figure class="otros__foto" data-reveal style="--i:2"><?php echo hanzing_img( hanzing_foto_id( 'complementos' ), '(min-width: 900px) 40vw, 100vw', array( 'alt' => 'Lona azul doblada, soplador para inflables y cinta' ) ); ?></figure>
		</div>
		<ul class="otros__lista">
			<?php foreach ( $otros as $n => $o ) : ?>
				<li data-reveal style="--i:<?php echo (int) $n; ?>">
					<div><strong><?php echo esc_html( $o[0] ); ?></strong><?php if ( $o[1] ) : ?><span><?php echo esc_html( $o[1] ); ?></span><?php endif; ?></div>
					<a class="link" href="<?php echo esc_url( hanzing_whatsapp( 'Hola, quiero cotizar ' . $o[0] . ' FIERAFLEX.' ) ); ?>" target="_blank" rel="noopener">Cotizar<span class="visually-hidden"> <?php echo esc_html( $o[0] ); ?></span></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
