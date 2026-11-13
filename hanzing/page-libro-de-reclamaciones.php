<?php
/**
 * Libro de reclamaciones.
 */
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array(
	'foto'     => 0,
	'compacto' => true,
	'titulo'   => 'Libro de reclamaciones',
	'lead'     => 'Si algo no salió como esperabas con tu pedido, regístralo aquí. Cada hoja recibe un número y te enviamos una copia a tu correo.',
) );
$razon = get_theme_mod( 'hz_razon_social' );
$rfc   = get_theme_mod( 'hz_rfc' );
$campo = function ( $id, $label, $tipo = 'text', $req = false, $extra = '' ) {
	printf(
		'<div class="field"><label for="%1$s">%2$s%3$s</label><input id="%1$s" name="%1$s" type="%4$s"%5$s%6$s></div>',
		esc_attr( $id ),
		esc_html( $label ),
		$req ? '' : ' <span>(opcional)</span>',
		esc_attr( $tipo ),
		$req ? ' required' : '',
		$extra // phpcs:ignore -- atributos fijos de esta plantilla.
	);
};
?>
<section class="section section--tight" aria-label="Hoja de reclamación">
	<div class="wrap reclamo">
		<aside class="reclamo__datos">
			<h2>Hoja de reclamación</h2>
			<dl>
				<div><dt>Hoja N.°</dt><dd><?php echo esc_html( hanzing_reclamo_siguiente() ); ?></dd></div>
				<div><dt>Fecha</dt><dd><?php echo esc_html( wp_date( 'd/m/Y' ) ); ?></dd></div>
				<div><dt>Proveedor</dt><dd><?php echo esc_html( $razon ?: 'Grupo Hanzing (FIERAFLEX)' ); ?></dd></div>
				<?php if ( $rfc ) : ?><div><dt>RFC</dt><dd><?php echo esc_html( $rfc ); ?></dd></div><?php endif; ?>
				<div><dt>Ubicación</dt><dd><?php echo esc_html( hanzing_contacto( 'direccion' ) ); ?></dd></div>
				<div><dt>Correo</dt><dd><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></dd></div>
			</dl>
			<p class="soft"><strong>Reclamo:</strong> inconformidad con el producto o servicio adquirido. <strong>Queja:</strong> malestar con la atención recibida.</p>
		</aside>

		<form class="form form--reclamo" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<div class="full"><?php hanzing_reclamo_aviso(); ?></div>
			<input type="hidden" name="action" value="hz_reclamo">
			<?php wp_nonce_field( 'hz_reclamo', 'hz_reclamo_nonce' ); ?>
			<div class="visually-hidden" aria-hidden="true"><label for="web">Deja este campo vacío</label><input id="web" name="web" type="text" tabindex="-1" autocomplete="off"></div>

			<h3 class="full">1. Tus datos</h3>
			<?php $campo( 'nombre', 'Nombre completo', 'text', true, ' autocomplete="name"' ); ?>
			<?php $campo( 'empresa', 'Empresa o razón social', 'text', false, ' autocomplete="organization"' ); ?>
			<div class="field"><label for="tipo_documento">Tipo de identificación</label>
				<select id="tipo_documento" name="tipo_documento"><option>INE</option><option>RFC</option><option>CURP</option><option>Pasaporte</option></select>
			</div>
			<?php $campo( 'numero_documento', 'Número de identificación', 'text', true ); ?>
			<?php $campo( 'telefono', 'Teléfono', 'tel', true, ' autocomplete="tel"' ); ?>
			<?php $campo( 'correo', 'Correo electrónico', 'email', true, ' autocomplete="email"' ); ?>
			<div class="field full"><label for="domicilio">Domicilio (ciudad y estado)</label><input id="domicilio" name="domicilio" type="text" required autocomplete="address-level2"></div>

			<h3 class="full">2. Producto o servicio</h3>
			<div class="field"><label for="tipo_bien">Producto o servicio</label>
				<select id="tipo_bien" name="tipo_bien"><option>Producto</option><option>Servicio</option></select>
			</div>
			<?php $campo( 'numero_pedido', 'N.° de pedido o factura', 'text' ); ?>
			<?php $campo( 'monto', 'Monto reclamado (MXN)', 'text', false, ' inputmode="decimal"' ); ?>
			<div class="field"><label for="descripcion_bien">Descripción</label><input id="descripcion_bien" name="descripcion_bien" type="text" required placeholder="Ej. 3 rollos de Black out 680"></div>

			<h3 class="full">3. Detalle</h3>
			<fieldset class="field full radios">
				<legend>Tipo</legend>
				<label><input type="radio" name="tipo_incidencia" value="reclamo" checked> Reclamo</label>
				<label><input type="radio" name="tipo_incidencia" value="queja"> Queja</label>
			</fieldset>
			<div class="field full"><label for="detalle">¿Qué pasó?</label><textarea id="detalle" name="detalle" rows="5" required></textarea></div>
			<div class="field full"><label for="pedido_consumidor">¿Qué solicitas?</label><textarea id="pedido_consumidor" name="pedido_consumidor" rows="3" required></textarea></div>

			<label class="check full"><input type="checkbox" name="declaracion" value="1" required> Declaro que los datos son correctos y acepto que Grupo Hanzing los use para atender esta hoja, según su <a class="link" href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>">política de privacidad</a>.</label>
			<div class="form__actions full"><button class="button button--accent" type="submit">Enviar hoja de reclamación</button></div>
		</form>
	</div>
</section>
<?php
get_footer();
