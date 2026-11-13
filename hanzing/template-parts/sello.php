<?php
/** Sello de marca: FIERAFLEX, producto de Grupo Hanzing. */
$ff = (int) get_option( 'hanzing_leon' ) ?: (int) get_option( 'hanzing_logo_fieraflex' );
?>
<p class="sello" data-load style="--d:<?php echo esc_attr( $args['d'] ?? '420ms' ); ?>">
	<?php echo $ff ? wp_get_attachment_image( $ff, 'full', false, array( 'alt' => '', 'loading' => 'eager', 'sizes' => '44px' ) ) : ''; ?>
	<span>FIERAFLEX, una marca de Grupo Hanzing</span>
</p>
