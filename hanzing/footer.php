</main>
<footer class="site-footer">
	<div class="wrap site-footer__top">
		<div class="site-footer__brand">
			<?php
			$hz = get_theme_mod( 'custom_logo' );
			echo $hz ? wp_get_attachment_image( $hz, 'full', false, array( 'alt' => 'Grupo Hanzing' ) ) : '';
			?>
			<p>Empresa mexicana dedicada a la venta y distribución de lonas de PVC de alta resistencia para aplicaciones industriales, comerciales, arquitectónicas y recreativas.</p>
		</div>
		<div class="site-footer__flagship">
			<?php
			$ff = (int) get_option( 'hanzing_logo_fieraflex' );
			echo $ff ? wp_get_attachment_image( $ff, 'full', false, array( 'alt' => 'Fieraflex' ) ) : '';
			?>
			<p><strong>Fieraflex</strong>, el producto insignia de Grupo Hanzing.</p>
		</div>
	</div>
	<div class="wrap site-footer__grid">
		<div>
			<h2>Lonas Fieraflex</h2>
			<ul>
				<?php foreach ( hanzing_lonas() as $l ) : ?>
					<li><a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo esc_html( $l['nombre'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<h2>Empresa</h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/nosotros/' ) ); ?>">Grupo Hanzing</a></li>
				<li><a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>">Servicios</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
			</ul>
		</div>
		<div>
			<h2>Contacto</h2>
			<ul>
				<li><a href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a></li>
				<li><a href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></li>
				<li><a href="<?php echo esc_url( hanzing_contacto( 'mapa' ) ); ?>" target="_blank" rel="noopener"><?php echo nl2br( esc_html( hanzing_contacto( 'direccion' ) ) ); ?></a></li>
			</ul>
		</div>
		<div>
			<h2>Horario</h2>
			<ul>
				<?php foreach ( hanzing_horario() as $h ) : ?>
					<li><?php echo esc_html( $h[0] ); ?><br><strong><?php echo esc_html( $h[1] ); ?></strong></li>
				<?php endforeach; ?>
			</ul>
			<h2 class="site-footer__sub">Redes</h2>
			<ul>
				<?php foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube' ) as $k => $label ) : ?>
					<?php if ( hanzing_contacto( $k ) ) : ?>
						<li><a href="<?php echo esc_url( hanzing_contacto( $k ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $label ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="site-footer__legal">
		<div class="wrap site-footer__legal-row">
			<span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Grupo Hanzing. Todos los derechos reservados.</span>
			<span>Fieraflex es una marca de Grupo Hanzing.</span>
		</div>
	</div>
</footer>
<a class="wa-float" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp"><?php echo hanzing_icon( 'whatsapp' ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
