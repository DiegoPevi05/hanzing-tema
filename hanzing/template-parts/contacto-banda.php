<?php
$titulo = $args['titulo'] ?? '¿Qué vas a fabricar?';
$texto  = $args['texto'] ?? 'Cuéntanos tu proyecto y te ayudamos a elegir la lona, el gramaje y el color. Respondemos en horario de oficina.';
?>
<section class="contact-band section" aria-labelledby="banda-title">
	<div class="wrap contact-band__grid">
		<div>
			<h2 id="banda-title" data-reveal><?php echo esc_html( $titulo ); ?></h2>
			<p class="lead" data-reveal style="--i:1"><?php echo esc_html( $texto ); ?></p>
		</div>
		<div class="contact-band__actions" data-reveal style="--i:2">
			<a class="button button--accent" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Escribir por WhatsApp</a>
			<a class="button button--ghost" href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo hanzing_icon( 'phone' ); ?> Llamar al <?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a>
			<a class="contact-band__mail" href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a>
		</div>
	</div>
</section>
