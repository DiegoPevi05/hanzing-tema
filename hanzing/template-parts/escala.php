<?php
/**
 * Compra a tu escala: minoristas y distribuidores (rangos confirmados por el cliente).
 */
$perfiles = array(
	array(
		'titulo' => 'Talleres y negocios',
		'rango'  => '1 a 30 rollos',
		'texto'  => 'Fabricantes de toldos, carpas, velarias, domos e inflables. Sin pedido mínimo: pide lo que tu proyecto necesita.',
		'msg'    => 'Hola, tengo un taller y quiero cotizar rollos de lona FIERAFLEX.',
		'boton'  => 'Cotizar para mi taller',
	),
	array(
		'titulo' => 'Distribuidores y mayoristas',
		'rango'  => '50 a 400 rollos',
		'texto'  => 'Propuestas por volumen, condiciones comerciales y logística de envío para surtir tu negocio.',
		'msg'    => 'Hola, soy distribuidor y quiero una propuesta por volumen de lona FIERAFLEX.',
		'boton'  => 'Pedir propuesta por volumen',
	),
);
?>
<section class="escala section section--steel" aria-labelledby="escala-title">
	<div class="wrap">
		<div class="head">
			<h2 id="escala-title" data-reveal>Compra a tu escala</h2>
			<p class="lead" data-reveal style="--i:1">Atendemos igual al taller que pide un rollo que al distribuidor que surte una región.</p>
		</div>
		<div class="escala__grid">
			<?php foreach ( $perfiles as $n => $p ) : ?>
				<article class="perfil" data-reveal style="--i:<?php echo (int) $n; ?>">
					<p class="perfil__rango"><?php echo esc_html( $p['rango'] ); ?></p>
					<h3><?php echo esc_html( $p['titulo'] ); ?></h3>
					<p><?php echo esc_html( $p['texto'] ); ?></p>
					<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp( $p['msg'] ) ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> <?php echo esc_html( $p['boton'] ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
