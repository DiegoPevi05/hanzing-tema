<?php
get_header();
$lonas = hanzing_lonas();
?>
<section class="page-hero">
	<?php echo hanzing_img( hanzing_foto_id( 'complementos' ), '100vw', array( 'loading' => 'eager', 'alt' => '' ) ); ?>
	<div class="page-hero__scrim"></div>
	<div class="wrap page-hero__body">
		<nav class="crumbs" aria-label="Ruta de navegación" data-load><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a><span aria-hidden="true">/</span><span>Fieraflex</span></nav>
		<h1 data-load style="--d:100ms">Lonas Fieraflex por gramaje</h1>
		<p class="lead" data-load style="--d:220ms">Lonas de PVC Fieraflex con refuerzo de poliéster de alta tenacidad. Elige por cuánto cuerpo necesita tu proyecto y cuánta luz debe pasar.</p>
		<?php get_template_part( 'template-parts/sello', null, array( 'd' => '320ms' ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/acomodo' ); ?>

<section class="section" aria-labelledby="compara-title">
	<div class="wrap">
		<div class="head">
			<h2 id="compara-title" data-reveal>Comparativa</h2>
			<p class="lead" data-reveal style="--i:1">Todas incluyen impermeabilidad, protección UV y antimoho. El retardante al fuego es opcional, bajo pedido.</p>
		</div>
		<div class="compare section--steel" role="region" aria-labelledby="compara-title" tabindex="0" data-reveal>
			<table>
				<thead><tr><th scope="col">Lona</th><th scope="col">Gramaje</th><th scope="col">Paso de luz</th><th scope="col">Ideal para</th></tr></thead>
				<tbody>
					<?php foreach ( $lonas as $l ) : ?>
						<tr>
							<th scope="row"><a class="compare__lona" href="<?php echo esc_url( $l['url'] ); ?>"><?php echo hanzing_img( $l['aplicacion_id'], '176px', array( 'alt' => '' ) ); ?><span class="link"><?php echo esc_html( $l['nombre'] ); ?></span></a></th>
							<td class="num" data-label="Gramaje"><?php echo (int) $l['gramaje']; ?> g/m²</td>
							<td data-label="Paso de luz"><?php echo esc_html( $l['luz'] ?: 'Consultar' ); ?></td>
							<td data-label="Ideal para"><?php echo esc_html( implode( ', ', $l['usos'] ) ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/contacto-banda', null, array( 'titulo' => '¿No sabes cuál pedir?', 'texto' => 'Mándanos una foto o una descripción del proyecto y te recomendamos la lona adecuada.' ) ); ?>
<?php
get_footer();
