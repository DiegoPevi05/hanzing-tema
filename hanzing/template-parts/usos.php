<?php
/** Usos de la lona con la lona recomendada para cada uno. */
?>
<section class="section" aria-labelledby="usos-title">
	<div class="wrap">
		<div class="head">
			<h2 id="usos-title" data-reveal>Dónde trabaja una lona Fieraflex</h2>
			<p class="lead" data-reveal style="--i:1">La lona que más nos piden para cada uso.</p>
		</div>
		<div class="apps">
			<?php
			$usos = array(
				array( 'carpa-boda', 'Carpas para eventos', 'lona-blackout-680' ),
				array( 'cubierta-industrial', 'Naves y cubiertas', 'lona-blackout-800' ),
				array( 'toldo-fachada', 'Toldos y fachadas', 'lona-traslucida-610' ),
				array( 'cancha-techada', 'Canchas techadas', 'lona-blackout-800' ),
				array( 'rollos-colores', 'Publicidad y banners', 'lona-blackout-610' ),
			);
			foreach ( $usos as $n => $u ) :
				$p = get_page_by_path( $u[2], OBJECT, 'lona' );
				if ( ! $p ) {
					continue;
				}
				?>
				<a class="app" href="<?php echo esc_url( get_permalink( $p ) ); ?>" data-reveal style="--i:<?php echo (int) $n % 3; ?>">
					<?php echo hanzing_img( hanzing_foto_id( $u[0] ), '(min-width: 900px) 50vw, 100vw' ); ?>
					<span class="app__label"><strong><?php echo esc_html( $u[1] ); ?></strong><span>Lona <?php echo esc_html( get_the_title( $p ) ); ?></span></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

