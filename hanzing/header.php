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
		<p>Envíos a todo México · Sin pedido mínimo · Rollos de 50 m</p>
		<ul>
			<li><a href="<?php echo esc_url( hanzing_telefono_href() ); ?>"><?php echo hanzing_icon( 'phone' ); ?><?php echo esc_html( hanzing_contacto( 'telefono' ) ); ?></a></li>
			<li><a href="mailto:<?php echo esc_attr( hanzing_contacto( 'email' ) ); ?>"><?php echo hanzing_icon( 'mail' ); ?><?php echo esc_html( hanzing_contacto( 'email' ) ); ?></a></li>
			<?php $h = hanzing_horario(); ?>
			<?php if ( $h ) : ?><li><?php echo hanzing_icon( 'reloj' ); ?><?php echo esc_html( $h[0][0] . ', ' . $h[0][1] ); ?></li><?php endif; ?>
		</ul>
	</div>
</div>
<?php
$lonas_menu = hanzing_lonas();
$inds_menu  = hanzing_industrias();
$actual     = is_post_type_archive( 'lona' ) || is_singular( 'lona' ) ? 'lonas' : ( is_tax( 'industria' ) || is_page( 'industrias' ) ? 'industrias' : ( is_page() ? get_post_field( 'post_name', get_queried_object_id() ) : '' ) );
$simples    = array( 'servicios' => 'Servicios', 'nosotros' => 'Empresa', 'contacto' => 'Contacto' );
?>
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
			<ul class="nav__list">
				<li class="nav__item has-sub<?php echo 'lonas' === $actual ? ' is-current' : ''; ?>">
					<a class="nav__link" href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Lonas</a>
					<button class="nav__toggle" type="button" aria-expanded="false" aria-controls="sub-lonas"><span class="visually-hidden">Ver lonas</span><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></button>
					<div class="sub" id="sub-lonas">
						<ul class="sub__list">
							<?php foreach ( $lonas_menu as $l ) : ?>
								<li><a href="<?php echo esc_url( $l['url'] ); ?>"><span><?php echo esc_html( $l['nombre'] ); ?></span><small><?php echo (int) $l['gramaje']; ?> g/m²<?php echo $l['luz'] ? ' · ' . esc_html( preg_replace( '/,.*$/', '', $l['luz'] ) ) : ''; ?></small></a></li>
							<?php endforeach; ?>
						</ul>
						<p class="sub__foot"><a href="<?php echo esc_url( get_post_type_archive_link( 'lona' ) ); ?>">Comparar todas las lonas →</a></p>
					</div>
				</li>
				<li class="nav__item has-sub<?php echo 'industrias' === $actual ? ' is-current' : ''; ?>">
					<a class="nav__link" href="<?php echo esc_url( home_url( '/industrias/' ) ); ?>">Industrias</a>
					<button class="nav__toggle" type="button" aria-expanded="false" aria-controls="sub-industrias"><span class="visually-hidden">Ver industrias</span><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></button>
					<div class="sub" id="sub-industrias">
						<ul class="sub__list">
							<?php foreach ( $inds_menu as $ind ) : ?>
								<li><a href="<?php echo esc_url( $ind['url'] ); ?>"><span><?php echo esc_html( $ind['nombre'] ); ?></span><?php if ( $ind['lonas'] ) : ?><small><?php echo esc_html( implode( ', ', array_slice( array_column( $ind['lonas'], 'nombre' ), 0, 2 ) ) ); ?></small><?php endif; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</li>
				<?php foreach ( $simples as $slug => $label ) : ?>
					<li class="nav__item<?php echo $slug === $actual ? ' is-current' : ''; ?>"><a class="nav__link" href="<?php echo esc_url( home_url( "/$slug/" ) ); ?>"<?php echo $slug === $actual ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<a class="button button--accent nav__cta" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener"><?php echo hanzing_icon( 'whatsapp' ); ?> Cotizar</a>
		</nav>
		<a class="wa-btn" href="<?php echo esc_url( hanzing_whatsapp() ); ?>" target="_blank" rel="noopener" aria-label="Cotizar por WhatsApp"><?php echo hanzing_icon( 'whatsapp' ); ?></a>
		<button class="menu-btn" type="button" aria-expanded="false" aria-controls="menu">
			<span class="menu-btn__bars" aria-hidden="true"><span></span><span></span></span>
			<span class="visually-hidden">Menú</span>
		</button>
	</div>
</header>
<main id="contenido">
