<?php
/**
 * The template for displaying the header.
 *
 * @package Additive
 * @since 0.1.0
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

    <section id="top-nav-section" class="top-nav-section">
      <?php if ( has_nav_menu( 'top' ) ) : ?>
        <div id="top-nav-container" class="container">
          <nav id="top-nav-menu" class="top-nav-menu">
            <img id="top-nav-uf-monogram" alt="UF Monogram" src="<?php echo bloginfo('template_url').'/images/UFmono.png'?>" />
            <?php
              wp_nav_menu( array(
                'theme_location' => 'top',
                'menu_class'     => 'top-menu',
               ) );
               get_search_form();
            ?>
          </nav>
        </div>
      <?php endif; ?>
    </section>
    <section id="content-section" class="content-section">
