<?php
$titulo = $args['titulo'] ?? '¿Qué vas a fabricar?';
$texto  = $args['texto'] ?? 'Cuéntanos tu proyecto y te ayudamos a elegir la lona, el gramaje y el color. Respondemos casi de inmediato en horario de atención.';
?>
<section class="contact-band" aria-labelledby="banda-title">
	<div class="wrap contact-band__grid">
		<div>
			<h2 id="banda-title" data-reveal><?php echo esc_html( $titulo ); ?></h2>
			<p class="lead" data-reveal style="--i:1"><?php echo esc_html( $texto ); ?></p>
		</div>
		<div class="contact-band__actions" data-reveal style="--i:2">
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar por WhatsApp</a>
			<a class="button button--outline" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Formulario de cotización</a>
			<p class="contact-band__datos"><a href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a> · <a href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></p>
		</div>
	</div>
</section>
