<?php
/**
 * Equipo: foto del equipo con revelado sobrio (cortina azul que se retira) y tres datos de la empresa.
 */
$datos = array(
	array( 'icon' => 'rollos', 't' => 'Almacén en León', 'd' => 'Rollos Fieraflex en existencia en Industrial Delta, León, Guanajuato.' ),
	array( 'icon' => 'asesoria', 't' => 'Asesoría técnica', 'd' => 'Te ayudamos a elegir gramaje y paso de luz antes de comprar.' ),
	array( 'icon' => 'persona', 't' => 'Atención personalizada', 'd' => 'Te atiende un asesor por WhatsApp, teléfono o correo.' ),
);
?>
<section class="equipo section" aria-labelledby="equipo-title">
	<div class="wrap">
		<div class="head">
			<h2 id="equipo-title" data-reveal>El equipo detrás de cada rollo</h2>
			<p class="lead" data-reveal style="--i:1">Desde nuestro almacén en León preparamos los pedidos y asesoramos a cada taller para que elija la lona correcta.</p>
		</div>
		<figure class="equipo__foto">
			<?php echo hanzing_img( hanzing_foto_id( 'equipo' ), '(min-width: 1200px) 1200px, 100vw', array( 'alt' => 'Equipo de Grupo Hanzing frente a los anaqueles de rollos de lona' ) ); ?>
			<span class="equipo__cortina" aria-hidden="true"></span>
			<figcaption>Equipo de Grupo Hanzing en el almacén de León</figcaption>
		</figure>
		<ul class="equipo__datos">
			<?php foreach ( $datos as $i => $d ) : ?>
				<li data-reveal style="--i:<?php echo (int) $i; ?>">
					<span class="equipo__icon"><?php echo hanzing_icon( $d['icon'] ); ?></span>
					<h3><?php echo esc_html( $d['t'] ); ?></h3>
					<p><?php echo esc_html( $d['d'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
