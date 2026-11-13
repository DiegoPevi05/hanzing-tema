<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#contenido">Saltar al contenido</a>
<div class="topbar">
	<div class="wrap topbar__row">
		<p>Grupo Hanzing, distribuidor de lonas de PVC Fieraflex desde León, Guanajuato</p>
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
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Grupo Hanzing. Ir al inicio">
			<?php
			$hz = get_theme_mod( 'custom_logo' );
			echo $hz ? wp_get_attachment_image( $hz, 'full', false, array( 'alt' => '', 'loading' => 'eager' ) ) : esc_html( get_bloginfo( 'name' ) );
			?>
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
