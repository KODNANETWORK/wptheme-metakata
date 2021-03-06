<?php
/**
 * Functions file
 *
 * This is the functions file in a WordPress theme.
 *
 * @link https://kodna.net/
 *
 * @package WordPress
 * @subpackage MetaKata
 * @since 0
*/
/*file load*/
function preload_scripts() {
wp_enqueue_style( 'style', get_stylesheet_uri() );
wp_enqueue_script( 'single-preloader', get_template_directory_uri() . '/assets/js/single-preloader.js', array( 'jquery' ) );
}
add_action ( 'wp_head', 'preload_scripts' );
function load_scripts() {
wp_register_style( 'FontAwesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
wp_enqueue_style( 'FontAwesome' );
wp_enqueue_script( 'three.min', get_template_directory_uri() . '/assets/js/three.min.js');
wp_enqueue_script( 'improvednoise', get_template_directory_uri() . '/assets/js/ImprovedNoise.js');
wp_enqueue_script( 'detector', get_template_directory_uri() . '/assets/js/Detector.js');
wp_enqueue_script( 'copyshader', get_template_directory_uri() . '/assets/js/shaders/CopyShader.js');
wp_enqueue_script( 'effectcomposer', get_template_directory_uri() . '/assets/js/postprocessing/EffectComposer.js');
wp_enqueue_script( 'renderpass', get_template_directory_uri() . '/assets/js/postprocessing/RenderPass.js');
wp_enqueue_script( 'maskpass', get_template_directory_uri() . '/assets/js/postprocessing/MaskPass.js');
wp_enqueue_script( 'shaderpass', get_template_directory_uri() . '/assets/js/postprocessing/ShaderPass.js');
wp_enqueue_script( 'digitalglitch', get_template_directory_uri() . '/assets/js/shaders/DigitalGlitch.js');
wp_enqueue_script( 'filmshader', get_template_directory_uri() . '/assets/js/shaders/FilmShader.js');
wp_enqueue_script( 'verticaltiltshiftshader', get_template_directory_uri() . '/assets/js/shaders/VerticalTiltShiftShader.js');
wp_enqueue_script( 'horizontaltiltshiftshader', get_template_directory_uri() . '/assets/js/shaders/HorizontalTiltShiftShader.js');
wp_enqueue_script( 'vignetteshader', get_template_directory_uri() . '/assets/js/shaders/VignetteShader.js');
wp_enqueue_script( 'glitchpass', get_template_directory_uri() . '/assets/js/postprocessing/GlitchPass.js');
wp_enqueue_script( 'call', get_template_directory_uri() . '/assets/js/Call.js', '', '', true);
}
add_action( 'wp_footer', 'load_scripts' );
/*html5 support*/
add_theme_support( 'html5', array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
'script',
'style',
'navigation-widgets',
)
);
/* responsive embeds */
add_theme_support( 'responsive-embeds' );
/*title tag support */
add_theme_support( 'title-tag' );
/* thumbnail support */
add_theme_support( 'post-thumbnails' );
/*upload logo function*/
add_theme_support( 'custom-logo' );
/*menu function*/
function register_menus() {
register_nav_menus( array(
'main-menu' => __( 'Main Menu' ),
'index-menu' => __( 'Index Menu' )
)
);
}
add_action( 'init', 'register_menus' );
/*customizer*/
require get_template_directory() . '/customizer.php';
/*woocommerce*/
function metakata_add_woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'metakata_add_woocommerce_support' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
/*hide version of wordpress*/
function wpb_remove_version() {
return '';
}
add_filter( 'the_generator', 'wpb_remove_version' );
/* hide welcome module function */
remove_action( 'welcome_panel', 'wp_welcome_panel' );
/* dashboard footer function */
function remove_footer_admin () {
echo '<p> Digital development by <a href="http://www.KODNA.net" target="_blank">KODNA Network</a></p>';
}
add_filter( 'admin_footer_text', 'remove_footer_admin' );
