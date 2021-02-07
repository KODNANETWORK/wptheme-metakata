<?php
/**
 * WordPress theme header file
 *
 * @link https://kodna.net/
 *
 * @package WordPress
 * @subpackage MetaKata
 * @since 0
*/
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php wp_title('');?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php wp_head(); ?>
</head>
<!-- preloader -->
<div class="preloader-div">
<div id="overlayer">
<span class="loader">
<span class="loader-inner"></span>
</span>
</div>
</div>
<body>
<main>
<div class="fp-site-banner">
<div><?php the_custom_logo(); ?></div>
<div class="site-id-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></div>
<div class="site-id-desc"><a href="<?php echo home_url(); ?>"><?php bloginfo('description'); ?></a></div>
<div class="menu-nav" role="navigation">
<div id="menuToggle">
<input type="checkbox"></input>
<span></span>
<span></span>
<span></span>
<div id="menu">
<div class="nav">
<ul class="menu">
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</ul>
</div>
</div>
</div>
</div>
</div>
