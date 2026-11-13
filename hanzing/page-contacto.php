<?php
get_header();
the_post();
get_template_part( 'template-parts/page-hero', null, array( 'foto' => get_post_thumbnail_id() ?: hanzing_foto_id( 'asesor' ), 'compacto' => true ) );
$wa = preg_replace( '/\D/', '', hanzing_contacto( 'whatsapp' ) );
?>
<section class="section section--tight" aria-label="Formulario de cotización">
	<div class="wrap contact-wrap">
		<?php if ( trim( get_the_content() ) ) : ?><div class="prose"><?php the_content(); ?></div><?php endif; ?>
		<div class="contact-grid">
			<form class="form" id="cotizar" novalidate data-whatsapp="<?php echo esc_attr( $wa ); ?>" data-email="<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>">
				<div class="field" data-reveal style="--i:0"><label for="nombre">Nombre</label><input id="nombre" name="nombre" type="text" autocomplete="name" required></div>
				<div class="field" data-reveal style="--i:1"><label for="empresa">Empresa <span>(opcional)</span></label><input id="empresa" name="empresa" type="text" autocomplete="organization"></div>
				<div class="field" data-reveal style="--i:2"><label for="ciudad">Ciudad</label><input id="ciudad" name="ciudad" type="text" autocomplete="address-level2"></div>
				<div class="field" data-reveal style="--i:3"><label for="rollos">Rollos que necesitas</label><input id="rollos" name="rollos" type="text" inputmode="numeric" placeholder="Ej. 3"></div>
				<div class="field full" data-reveal style="--i:3"><label for="lona">Lona que te interesa</label>
					<select id="lona" name="lona">
						<option value="">Aún no sé, necesito asesoría</option>
						<?php foreach ( hanzing_lonas() as $l ) : ?><option value="<?php echo esc_attr( $l['nombre'] . ' g/m²' ); ?>"><?php echo esc_html( $l['nombre'] . ' g/m²' ); ?></option><?php endforeach; ?>
					</select>
				</div>
				<div class="field full" data-reveal style="--i:4"><label for="mensaje">Tu proyecto</label><textarea id="mensaje" name="mensaje" rows="5" required placeholder="Ej. 2 rollos de Traslúcida 610 en azul para toldos."></textarea></div>
				<p class="form__nota full">Al enviar, tus datos se usan solo para cotizar, según nuestra <a class="link" href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>">política de privacidad</a>.</p>
				<p class="form__error full" role="alert" hidden>Escribe tu nombre y cuéntanos tu proyecto para poder cotizar.</p>
				<div class="form__actions full" data-reveal style="--i:5">
					<button class="button button--accent" type="submit"><?php echo hanzing_icon( 'whatsapp' ); ?> Enviar por WhatsApp</button>
					<button class="button button--plain" type="submit" data-via="email"><?php echo hanzing_icon( 'mail' ); ?> Enviar por correo</button>
				</div>
			</form>
			<aside class="info">
				<div data-reveal>
					<h2>Ventas</h2>
					<?php echo hanzing_img( hanzing_foto_id( 'atencion-ventas' ), '(min-width: 1000px) 30vw, 100vw', array( 'alt' => 'Ejecutiva de ventas de Grupo Hanzing atendiendo una llamada' ) ); ?>
					<p><a class="link" href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a> (teléfono y WhatsApp)</p>
					<p><a class="link" href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></p>
					<?php if ( hanzing_contacto( 'email2' ) ) : ?><p><a class="link" href="mailto:<?php echo esc_attr( hanzing_contacto( 'email2' ) ); ?>"><?php echo esc_html( hanzing_contacto( 'email2' ) ); ?></a></p><?php endif; ?>
				</div>
				<div data-reveal style="--i:1">
					<h2>Ubicación y envíos</h2>
					<?php echo hanzing_img( hanzing_foto_id( 'equipo' ), '(min-width: 1000px) 30vw, 100vw', array( 'alt' => 'Equipo de Grupo Hanzing frente a los anaqueles de rollos de lona' ) ); ?>
					<p><?php echo nl2br( esc_html( hanzing_contacto( 'direccion' ) ) ); ?></p>
					<p class="soft">Enviamos a todo México con paquetería en convenio. Revisamos la cobertura de tu localidad al cotizar.</p>
					<?php if ( hanzing_contacto( 'mapa' ) ) : ?><p><a class="link" href="<?php echo esc_url( hanzing_contacto( 'mapa' ) ); ?>" target="_blank" rel="noopener">Abrir en Google Maps</a></p><?php endif; ?>
				</div>
				<div data-reveal style="--i:2">
					<h2>Horario</h2>
					<dl class="hours"><?php foreach ( hanzing_horario() as $h ) : ?><div><dt><?php echo esc_html( $h[0] ); ?></dt><dd><?php echo esc_html( $h[1] ); ?></dd></div><?php endforeach; ?></dl>
				</div>
			</aside>
		</div>
	</div>
</section>
<figure class="contact-photo" data-reveal>
	<?php echo hanzing_img( hanzing_foto_id( 'rollos-colores' ), '100vw', array( 'alt' => 'Rollos de lona FIERAFLEX de colores' ) ); ?>
</figure>
<?php
get_footer();
