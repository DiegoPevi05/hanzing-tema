<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?><?php echo is_singular( 'lona' ) ? ' data-producto="' . esc_attr( get_the_title() ) . '"' : ''; ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#contenido">Saltar al contenido</a>
<div class="topbar">
	<div class="wrap topbar__row">
		<p>FIERAFLEX, rollos de lona de PVC · Una marca de Grupo Hanzing</p>
		<ul>
			<li><a href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo hanzing_icon( 'phone' ); ?><?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a></li>
			<li><a href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo hanzing_icon( 'mail' ); ?><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></li>
			<?php $h = hanzing_horario(); ?>
			<?php if ( $h ) : ?><li><?php echo esc_html( $h[0][0] . ', ' . $h[0][1] ); ?></li><?php endif; ?>
		</ul>
	</div>
</div>
<header class="site-header" data-header>
	<div class="wrap site-header__bar">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="FIERAFLEX, una marca de Grupo Hanzing. Ir al inicio">
			<?php
			// Arquitectura endosada (manual 2026): FIERAFLEX protagonista, Grupo Hanzing como sello de respaldo.
			$ff = (int) get_option( 'hanzing_logo_fieraflex_h' );
			echo $ff ? wp_get_attachment_image( $ff, 'full', false, array( 'alt' => '', 'loading' => 'eager', 'class' => 'brand__ff' ) ) : '<span class="brand__txt">FIERAFLEX</span>';
			?>
			<span class="brand__endoso" aria-hidden="true">una marca de<br><strong>Grupo Hanzing</strong></span>
		</a>
		<nav id="menu" class="nav" aria-label="Principal">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'principal',
				'container'      => false,
				'fallback_cb'    => false,
				'depth'          => 1,
			) );
			?>
			<a class="button button--accent nav__cta" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar</a>
		</nav>
		<button class="menu-btn" type="button" aria-expanded="false" aria-controls="menu">
			<span class="menu-btn__bars" aria-hidden="true"><span></span><span></span></span>
			<span class="visually-hidden">Menú</span>
		</button>
	</div>
</header>
<main id="contenido">
