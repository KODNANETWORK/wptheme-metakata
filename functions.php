<?php
/**
* The functions file
* This is the functions file in a WordPress theme.
* @link https://kodna.net/
* @package WordPress
* @subpackage MetaKata
* @since 0
*/
/*wp_enqueue file loading */
function load_scripts() {
wp_enqueue_style( 'style', get_stylesheet_uri() );
wp_register_style( 'FontAwesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
wp_enqueue_style('FontAwesome');
wp_register_style( 'Gfonts', 'https://fonts.googleapis.com/css?family=Raleway' );
wp_enqueue_style('Gfonts');
wp_enqueue_script( 'single-preloader', get_template_directory_uri() . '/assets/js/single-preloader.js', array( 'jquery' ) );
wp_enqueue_script( 'preloader', get_template_directory_uri() . '/assets/js/preloader.js', array( 'jquery' ) );
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
/*wp_enqueue scripts*/
add_action( 'wp_footer', 'load_scripts' );
/*title tag support */
add_theme_support( 'title-tag' );
/*upload logo function*/
add_theme_support( 'custom-logo' );
/*menu function*/
function register_menus() {
register_nav_menus( array(
'main menu' => __( 'Main Menu' ),
'index menu' => __( 'Index Menu' )
)
);
}
add_action( 'init', 'register_menus' );
/*random post function (url.com/random/)*/
function random_add_rewrite() {
global $wp;
$wp->add_query_var('random');
add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}
add_action('template_redirect','random_template');
function random_template() {
if (get_query_var('random') == 1) {
$posts = get_posts('post_type=post&orderby=rand&numberposts=1');
foreach($posts as $post) {
$link = get_permalink($post);
}
wp_redirect($link,307);
exit;
}
}
add_action('init','random_add_rewrite');
/* hide version of wordPress */
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');
/* hide welcome module function */
remove_action('welcome_panel', 'wp_welcome_panel');
/* allow .psd .zip & .svg media uploads */
function my_myme_types($mime_types){
$mime_types['svg'] = 'image/svg+xml';
//svg files
$mime_types['psd'] = 'image/vnd.adobe.photoshop';
//psd files
$mime_types['zip'] = 'application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip';
//zip files
return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);
/* dashboard footer function */
function remove_footer_admin () {
echo 'Digital development by <a href="http://www.KODNA.net" target="_blank">KODNA Network</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
/* customizer */
require get_template_directory() . '/customizer.php';
?>
