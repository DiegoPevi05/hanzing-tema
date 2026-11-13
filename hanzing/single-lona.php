<?php
get_header();
the_post();
$l      = hanzing_lona();
$msg    = 'Hola, quiero cotizar Lona ' . $l['nombre'] . ' g/m² FIERAFLEX.';
$hechos = array_filter( array(
	'Gramaje'             => $l['gramaje'] . ' g/m²',
	'Paso de luz'         => $l['luz'],
	'Material'            => 'PVC de alto peso molecular sobre tejido de poliéster de alta resistencia',
	'Tratamientos'        => 'Impermeable, anti-UV, antibacteriana y antimoho',
	'Uso'                 => 'Interior y exterior',
	'Colores'             => $l['colores'],
	'Ideal para'          => implode( ', ', $l['usos'] ),
	'Presentación'        => $l['rollo'] . '. Sin pedido mínimo.',
) );
$otras  = array_filter( hanzing_lonas(), fn( $o ) => $o['id'] !== $l['id'] );
?>
<?php
ob_start();
?>
<p class="panel__peso"><strong><?php echo (int) $l['gramaje']; ?></strong> g/m²<?php echo $l['luz'] ? ' · ' . esc_html( preg_replace( '/,.*$/', '', $l['luz'] ) ) : ''; ?> · <?php echo esc_html( $l['rollo'] ); ?></p>
<div class="actions">
	<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( $msg ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar esta lona</a>
	<?php if ( $l['ficha_url'] ) : ?><a class="button button--outline" href="<?php echo esc_url( $l['ficha_url'] ); ?>" target="_blank" rel="noopener" download>Ficha técnica</a><?php endif; ?>
</div>
<?php
get_template_part( 'template-parts/page-hero', null, array(
	'foto'   => $l['aplicacion_id'],
	'alt'    => $l['aplicacion_alt'],
	'titulo' => 'Lona ' . $l['nombre'],
	'lead'   => $l['resumen'],
	'crumbs' => array( array( 'Lonas', get_post_type_archive_link( 'lona' ) ) ),
	'extra'  => ob_get_clean(),
) );
?>

<section class="section" aria-labelledby="ficha-title">
	<div class="wrap ficha">
		<div class="ficha__head">
			<h2 id="ficha-title" data-reveal>Ficha técnica</h2>
			<?php echo $l['muestra_id'] ? wp_get_attachment_image( $l['muestra_id'], 'full', false, array( 'class' => 'ficha__swatch', 'alt' => 'Muestra de lona ' . $l['nombre'], 'loading' => 'lazy', 'sizes' => '260px' ) ) : ''; ?>
			<div class="prose soft" data-reveal style="--i:1"><?php the_content(); ?></div>
			<?php if ( $l['ficha_url'] ) : ?>
				<a class="button button--field" href="<?php echo esc_url( $l['ficha_url'] ); ?>" target="_blank" rel="noopener" download data-reveal style="--i:2"><?php echo hanzing_icon( 'pdf' ); ?> Descargar ficha técnica</a>
			<?php endif; ?>
		</div>
		<dl class="ficha__list">
			<?php $i = 0; foreach ( $hechos as $k => $v ) : ?>
				<div data-reveal style="--i:<?php echo (int) $i++; ?>"><dt><?php echo esc_html( $k ); ?></dt><dd><?php echo esc_html( $v ); ?></dd></div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>

<?php if ( $l['specs'] ) : ?>
<section class="section section--steel" aria-labelledby="params-title">
	<div class="wrap">
		<div class="head">
			<h2 id="params-title" data-reveal>Parámetros técnicos</h2>
			<p class="lead" data-reveal style="--i:1">Valores de referencia de la ficha técnica; prevalece el informe de prueba de cada lote.</p>
		</div>
		<div class="params" role="region" aria-labelledby="params-title" tabindex="0" data-reveal>
			<table>
				<thead><tr><th scope="col">Parámetro</th><th scope="col">Valor</th><th scope="col">Método de prueba</th></tr></thead>
				<tbody>
					<?php foreach ( $l['specs'] as $sp ) : ?>
						<tr><th scope="row"><?php echo esc_html( $sp['nombre'] ); ?></th><td class="num"><?php echo esc_html( $sp['valor'] ); ?></td><td><?php echo esc_html( $sp['norma'] ?: '—' ); ?></td></tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/luz-mini', null, array( 'lona' => $l ) ); ?>

<section class="section" aria-labelledby="otras-title">
	<div class="wrap">
		<div class="bar"><h2 id="otras-title" data-reveal>Otras lonas FIERAFLEX</h2></div>
		<ul class="cards">
			<?php $i = 0; foreach ( $otras as $o ) : ?>
				<?php get_template_part( 'template-parts/lona-card', null, array( 'lona' => $o, 'i' => $i++ ) ); ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
