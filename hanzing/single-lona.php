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
<section class="page-hero">
	<?php echo hanzing_img( $l['aplicacion_id'], '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => $l['aplicacion_alt'] ) ); ?>
	<div class="page-hero__scrim"></div>
	<div class="wrap page-hero__body">
		<nav class="crumbs" aria-label="Ruta de navegación" data-load><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">FIERAFLEX</a></nav>
		<?php $base = trim( preg_replace( '/\s*\d+\s*$/', '', $l['nombre'] ) ); ?>
		<h1 data-load style="--d:100ms">Lona <?php echo esc_html( $base ); ?><span class="visually-hidden"> <?php echo (int) $l['gramaje']; ?> g/m²</span></h1>
		<p class="gramaje-big" data-load style="--d:180ms" aria-hidden="true"><span><?php echo (int) $l['gramaje']; ?></span> g/m²</p>
		<div class="hero__actions" data-load style="--d:260ms">
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( $msg ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar esta lona</a>
			<a class="button button--ghost" href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo hanzing_icon( 'phone' ); ?> <?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a>
		</div>
		<?php get_template_part( 'template-parts/sello' ); ?>
	</div>
</section>

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
		<div class="head"><h2 id="otras-title" data-reveal>Otras lonas FIERAFLEX</h2></div>
		<ul class="lonas-list">
			<?php $i = 0; foreach ( $otras as $o ) : ?>
				<li class="lona-item" data-reveal style="--i:<?php echo (int) $i++ % 3; ?>">
					<a href="<?php echo esc_url( $o['url'] ); ?>">
						<div class="lona-item__img"><?php echo hanzing_img( $o['aplicacion_id'], '(min-width: 900px) 33vw, 100vw', array( 'alt' => $o['aplicacion_alt'] ) ); ?></div>
						<div class="lona-item__line"><span class="lona-item__name"><?php echo esc_html( $o['nombre'] ); ?></span><span class="lona-item__weight"><?php echo (int) $o['gramaje']; ?> g/m²</span></div>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
