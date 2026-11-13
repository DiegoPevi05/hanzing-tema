</main>
<footer class="site-footer">
	<div class="wrap site-footer__top">
		<div class="site-footer__brand">
			<?php
			$hz = get_theme_mod( 'custom_logo' );
			echo $hz ? wp_get_attachment_image( $hz, 'full', false, array( 'alt' => 'Grupo Hanzing' ) ) : '';
			?>
			<p><strong>FIERAFLEX, una marca de Grupo Hanzing.</strong> Rollos de lona de PVC para toldos, velarias, carpas, domos, inflables e industria, con envío a todo México.</p>
		</div>
	</div>
	<div class="wrap site-footer__grid">
		<div>
			<h2>Lonas FIERAFLEX</h2>
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
				<li><?php echo nl2br( esc_html( hanzing_contacto( 'direccion' ) ) ); ?></li>
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
			<span>FIERAFLEX es una marca de Grupo Hanzing.</span>
			<a class="site-footer__credit" href="https://medialitica.pe" target="_blank" rel="noopener noreferrer">Web desarrollada por Medialitica.pe</a>
		</div>
	</div>
</footer>
<a class="wa-float" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp"><?php echo hanzing_icon( 'whatsapp' ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
