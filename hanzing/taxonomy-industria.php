<?php
get_header();
$term = get_queried_object();
$ind  = hanzing_industria( $term );
?>
<?php
$extra = '<div class="actions"><a class="button button--accent" href="' . esc_url( hanzing_whatsapp( 'Hola, busco lona FIERAFLEX para ' . mb_strtolower( $ind['nombre'] ) . '.' ) ) . '" target="_blank" rel="noopener">' . hanzing_icon( 'whatsapp' ) . ' Cotizar para ' . esc_html( mb_strtolower( $ind['nombre'] ) ) . '</a></div>';
get_template_part( 'template-parts/page-hero', null, array(
	'foto'   => $ind['foto_id'],
	'titulo' => $ind['nombre'],
	'lead'   => $ind['texto'],
	'crumbs' => array( array( 'Industrias', home_url( '/industrias/' ) ) ),
	'extra'  => $extra,
) );
?>

<section class="section" aria-labelledby="recomendadas-title">
	<div class="wrap">
		<div class="bar">
			<h2 id="recomendadas-title" data-reveal>Lonas FIERAFLEX recomendadas</h2>
			<p class="lead" data-reveal style="--i:1">Las líneas que más se usan para <?php echo esc_html( mb_strtolower( $ind['nombre'] ) ); ?>. Si tu proyecto es distinto, te asesoramos.</p>
		</div>
		<?php if ( $ind['lonas'] ) : ?>
			<ul class="cards">
				<?php foreach ( $ind['lonas'] as $i => $l ) : ?>
					<?php get_template_part( 'template-parts/lona-card', null, array( 'lona' => $l, 'i' => $i ) ); ?>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p class="lead">Aún no hay lonas asignadas a esta industria. Escríbenos y te recomendamos la adecuada.</p>
		<?php endif; ?>
	</div>
</section>

<section class="section section--steel" aria-labelledby="otras-ind-title">
	<div class="wrap">
		<div class="bar"><h2 id="otras-ind-title" data-reveal>Otras industrias</h2></div>
		<?php get_template_part( 'template-parts/industrias-grid', null, array( 'excluir' => $ind['id'] ) ); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/contacto-banda' ); ?>
<?php
get_footer();
