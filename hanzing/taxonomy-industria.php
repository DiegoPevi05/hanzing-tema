<?php
get_header();
$term = get_queried_object();
$ind  = hanzing_industria( $term );
?>
<section class="page-hero">
	<?php echo hanzing_img( $ind['foto_id'], '100vw', array( 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => '' ) ); ?>
	<div class="page-hero__scrim"></div>
	<div class="wrap page-hero__body">
		<nav class="crumbs" aria-label="Ruta de navegación" data-load><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( home_url( '/industrias/' ) ); ?>">Industrias</a></nav>
		<h1 data-load style="--d:100ms"><?php echo esc_html( $ind['nombre'] ); ?></h1>
		<?php if ( $ind['texto'] ) : ?><p class="lead" data-load style="--d:220ms"><?php echo esc_html( $ind['texto'] ); ?></p><?php endif; ?>
		<div class="hero__actions" data-load style="--d:320ms">
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( 'Hola, busco lona FIERAFLEX para ' . mb_strtolower( $ind['nombre'] ) . '.' ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar para <?php echo esc_html( mb_strtolower( $ind['nombre'] ) ); ?></a>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="recomendadas-title">
	<div class="wrap">
		<div class="head">
			<h2 id="recomendadas-title" data-reveal>Lonas FIERAFLEX recomendadas</h2>
			<p class="lead" data-reveal style="--i:1">Las líneas que más se usan para <?php echo esc_html( mb_strtolower( $ind['nombre'] ) ); ?>. Si tu proyecto es distinto, te asesoramos.</p>
		</div>
		<?php if ( $ind['lonas'] ) : ?>
			<ul class="lonas-list">
				<?php foreach ( $ind['lonas'] as $i => $l ) : ?>
					<li class="lona-item" data-reveal style="--i:<?php echo (int) $i % 3; ?>">
						<a href="<?php echo esc_url( $l['url'] ); ?>">
							<div class="lona-item__img"><?php echo hanzing_img( $l['aplicacion_id'], '(min-width: 900px) 33vw, 100vw', array( 'alt' => $l['aplicacion_alt'] ) ); ?></div>
							<div class="lona-item__line"><span class="lona-item__name"><?php echo esc_html( $l['nombre'] ); ?></span><span class="lona-item__weight"><?php echo (int) $l['gramaje']; ?> g/m²</span></div>
							<p class="lona-item__desc"><?php echo esc_html( $l['resumen'] ); ?></p>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p class="lead">Aún no hay lonas asignadas a esta industria. Escríbenos y te recomendamos la adecuada.</p>
		<?php endif; ?>
	</div>
</section>

<section class="section section--steel" aria-labelledby="otras-ind-title">
	<div class="wrap">
		<div class="head"><h2 id="otras-ind-title" data-reveal>Otras industrias</h2></div>
		<?php get_template_part( 'template-parts/industrias-grid', null, array( 'excluir' => $ind['id'] ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
