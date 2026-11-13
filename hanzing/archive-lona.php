<?php
get_header();
$lonas = hanzing_lonas();
?>
<?php
get_template_part( 'template-parts/page-hero', null, array(
	'foto'   => hanzing_foto_id( 'complementos' ),
	'titulo' => 'Rollos de lona FIERAFLEX',
	'lead'   => 'Lona de PVC sobre tejido de poliéster de alta resistencia, en rollos de 50 m y sin pedido mínimo. Elige por cuánto cuerpo necesita tu proyecto y cuánta luz debe pasar.',
) );
?>

<section class="section" aria-labelledby="catalogo-title">
	<div class="wrap">
		<h2 id="catalogo-title" class="visually-hidden">Catálogo</h2>
		<ul class="cards">
			<?php foreach ( $lonas as $i => $l ) : ?>
				<?php get_template_part( 'template-parts/lona-card', null, array( 'lona' => $l, 'i' => $i ) ); ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/acomodo' ); ?>

<section class="section" aria-labelledby="compara-title">
	<div class="wrap">
		<div class="head">
			<h2 id="compara-title" data-reveal>Comparativa</h2>
			<p class="lead" data-reveal style="--i:1">Todas son impermeables, anti-UV y antimoho, y se venden en rollos de 50 m sin pedido mínimo.</p>
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

<?php get_template_part( 'template-parts/luz' ); ?>

<?php get_template_part( 'template-parts/capas' ); ?>

<?php get_template_part( 'template-parts/otros-productos' ); ?>

<?php get_template_part( 'template-parts/contacto-banda', null, array( 'titulo' => '¿No sabes cuál pedir?', 'texto' => 'Mándanos una foto o una descripción del proyecto y te recomendamos la lona adecuada.' ) ); ?>
<?php
get_footer();
