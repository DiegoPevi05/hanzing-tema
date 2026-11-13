<?php
/**
 * Fieraflex, el producto insignia de Grupo Hanzing.
 */
$ff    = (int) get_option( 'hanzing_logo_fieraflex' );
$lonas = hanzing_lonas();
$min   = $lonas ? min( array_column( $lonas, 'gramaje' ) ) : 0;
$max   = $lonas ? max( array_column( $lonas, 'gramaje' ) ) : 0;
?>
<section class="insignia section" aria-labelledby="insignia-title">
	<div class="wrap insignia__grid">
		<div class="insignia__mark" data-reveal>
			<?php echo $ff ? wp_get_attachment_image( $ff, 'full', false, array( 'alt' => 'Fieraflex', 'loading' => 'lazy', 'sizes' => '(min-width: 900px) 320px, 220px' ) ) : ''; ?>
		</div>
		<div class="insignia__body">
			<h2 id="insignia-title" data-reveal>Fieraflex, nuestra lona insignia</h2>
			<p class="lead" data-reveal style="--i:1">El producto bandera de Grupo Hanzing: lona de PVC con refuerzo de poliéster de alta tenacidad, pensada para trabajar a la intemperie en carpas, velarias, toldos, inflables y cubiertas.</p>
			<dl class="insignia__facts" data-reveal style="--i:2">
				<div><dt>Líneas</dt><dd><?php echo count( $lonas ); ?> lonas</dd></div>
				<div><dt>Gramajes</dt><dd><?php echo (int) $min; ?> a <?php echo (int) $max; ?> g/m²</dd></div>
				<div><dt>Tratamientos</dt><dd>UV y antimoho</dd></div>
				<div><dt>Opcional</dt><dd>Retardante al fuego</dd></div>
			</dl>
			<a class="button button--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>" data-reveal style="--i:3">Conocer la línea Fieraflex</a>
		</div>
	</div>
</section>
