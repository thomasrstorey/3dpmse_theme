<?php

/**
 * Additive functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package Additive
 * @since 0.1.0
 */

// Useful global constants
define( 'ADDITIVE_VERSION',      '0.1.0' );
define( 'ADDITIVE_URL',          get_stylesheet_directory_uri() );
define( 'ADDITIVE_TEMPLATE_URL', get_template_directory_uri() );
define( 'ADDITIVE_PATH',         get_template_directory() . '/' );
define( 'ADDITIVE_INC',          ADDITIVE_PATH . 'includes/' );
define( 'ADDITIVE_IMGS',         ADDITIVE_PATH . 'images/' );

// Include compartmentalized functions
require_once ADDITIVE_INC . 'functions/core.php';

// Include lib classes

// Run the setup functions
ThomasRStorey\Additive\Core\setup();
