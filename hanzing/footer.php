</main>
<footer class="site-footer">
	<div class="wrap site-footer__grid">
		<div class="site-footer__brand">
			<?php
			$ff = (int) get_option( 'hanzing_logo_fieraflex_h' );
			echo $ff ? wp_get_attachment_image( $ff, 'full', false, array( 'alt' => 'FIERAFLEX', 'class' => 'site-footer__ff', 'loading' => 'lazy' ) ) : '';
			?>
			<p>Rollos de lona de PVC para toldos, velarias, carpas, domos, inflables e industria, con envío a todo México.</p>
			<div class="site-footer__endoso">
				<?php
				$hz = get_theme_mod( 'custom_logo' );
				echo $hz ? wp_get_attachment_image( $hz, 'full', false, array( 'alt' => 'Grupo Hanzing', 'loading' => 'lazy' ) ) : '';
				?>
				<span>FIERAFLEX es una marca de<br><strong>Grupo Hanzing</strong></span>
			</div>
		</div>
		<div>
			<h2>Lonas</h2>
			<ul>
				<?php foreach ( hanzing_lonas() as $l ) : ?>
					<li><a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo esc_html( $l['nombre'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<h2>Empresa</h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/industrias/' ) ); ?>">Industrias</a></li>
				<li><a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>">Servicios</a></li>
				<li><a href="<?php echo esc_url( home_url( '/nosotros/' ) ); ?>">Grupo Hanzing</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
				<li><a href="<?php echo esc_url( home_url( '/terminos-y-condiciones/' ) ); ?>">Términos y condiciones</a></li>
				<li><a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>">Política de privacidad</a></li>
				<li><a href="<?php echo esc_url( home_url( '/libro-de-reclamaciones/' ) ); ?>">Libro de reclamaciones</a></li>
			</ul>
		</div>
		<div>
			<h2>Redes</h2>
			<ul>
				<?php foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube' ) as $k => $label ) : ?>
					<?php if ( hanzing_contacto( $k ) ) : ?>
						<li><a href="<?php echo esc_url( hanzing_contacto( $k ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $label ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<h2>Contacto</h2>
			<ul>
				<li><a href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener">Contáctanos</a></li>
				<li><a href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></li>
				<li><?php echo nl2br( esc_html( hanzing_contacto( 'direccion' ) ) ); ?></li>
			</ul>
			<h2 class="site-footer__sub">Horario</h2>
			<ul>
				<?php foreach ( hanzing_horario() as $h ) : ?>
					<li><?php echo esc_html( $h[0] ); ?>: <?php echo esc_html( $h[1] ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="wrap site-footer__legal">
		<span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> FIERAFLEX, una marca de Grupo Hanzing. Todos los derechos reservados.</span>
		<a class="site-footer__credit" href="https://medialitica.pe" target="_blank" rel="noopener noreferrer">Web desarrollada por Medialitica.pe</a>
	</div>
</footer>
<a class="wa-float" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp"><?php echo hanzing_icon( 'whatsapp' ); ?></a>
<?php wp_footer(); ?>
</body>
</html>
