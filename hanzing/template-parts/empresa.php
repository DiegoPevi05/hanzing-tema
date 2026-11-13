<?php
/**
 * Grupo Hanzing, la empresa.
 */
?>
<section class="empresa section section--steel" aria-labelledby="empresa-title">
	<div class="wrap">
		<div class="head">
			<h2 id="empresa-title" data-reveal>Grupo Hanzing</h2>
			<p class="lead" data-reveal style="--i:1">Empresa mexicana de León, Guanajuato, dedicada a la venta y distribución de lonas de PVC de alta resistencia.</p>
		</div>
		<div class="empresa__grid">
			<figure class="empresa__photo" data-reveal>
				<?php echo hanzing_img( hanzing_foto_id( 'almacen-hanzing' ), '(min-width: 900px) 55vw, 100vw', array( 'alt' => 'Almacén de Grupo Hanzing en Industrial Delta, León, con camión de reparto' ) ); ?>
				<figcaption>Almacén en Industrial Delta, León.</figcaption>
			</figure>
			<div class="empresa__body">
				<dl class="empresa__pillars">
					<div data-reveal style="--i:1"><dt>Disponibilidad constante</dt><dd>Rollos Fieraflex en existencia para que tu taller no se detenga.</dd></div>
					<div data-reveal style="--i:2"><dt>Atención personalizada</dt><dd>Hablas con alguien que conoce el material y tu tipo de proyecto.</dd></div>
					<div data-reveal style="--i:3"><dt>Asesoría técnica</dt><dd>Te ayudamos a elegir gramaje y tipo de lona antes de comprar.</dd></div>
				</dl>
				<a class="button button--field" href="<?php echo esc_url( home_url( '/nosotros/' ) ); ?>" data-reveal style="--i:4">Conocer la empresa</a>
			</div>
		</div>
		<div class="empresa__mv">
			<div data-reveal><h3>Misión</h3><p>Ofrecer lonas de PVC de alta calidad con durabilidad, resistencia y disponibilidad constante, con atención profesional y personalizada.</p></div>
			<div data-reveal style="--i:1"><h3>Visión</h3><p>Consolidarnos como marca líder a nivel nacional en la comercialización y distribución de lona de PVC.</p></div>
			<figure data-reveal style="--i:2"><?php echo hanzing_img( hanzing_foto_id( 'equipo' ), '(min-width: 900px) 33vw, 100vw', array( 'alt' => 'Equipo de Grupo Hanzing frente a los anaqueles de rollos de lona' ) ); ?></figure>
		</div>
	</div>
</section>
