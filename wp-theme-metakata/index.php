<?php
/**
 * Index file
 *
 * This is the index template file in a WordPress theme.
 *
 * @link https://kodna.net/
 *
 * @package WordPress
 * @subpackage MetaKata
 * @since 0
*/
get_header();
?>
<div id="primary" class="content-area">
<div class="i-content-area">
<div class="i-logo-div"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_theme_mod('ikon_img_settings') ?>" class="i-custom-logo"></img></a></div>
<div class="banner-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></div>
<div class="banner-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('description'); ?></a></div>
<div class="single-nav">
<input class="single-menu-btn" type="checkbox" id="single-menu-btn"/>
<label class="single-menu-icon" for="single-menu-btn"><span class="single-navicon"></span></label>
<ul class="single-menu"><?php wp_nav_menu( array( 'theme_location' => 'index-menu' ) ); ?></ul>
</div>
</div>
<div class="nullcanvas" id="canvas"></div>
<div class="i-posts-area"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="post" role="article" itemscope itemtype="http://schema.org/Article">
<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
<div class="post_meta"><time class="post_date" datetime="<?php the_time('Y-m-d'); ?>"itemprop="datePublished"><?php the_time(__('F j, Y')); ?></time></div>
<div class="postcontent_list" itemprop="articleBody" data-type-cleanup="true"><?php the_content('Read More &raquo;'); ?></div>
</article>
<?php endwhile; endif; ?>
<div class="nav_links"><?php posts_nav_link(); ?></div>
</div>
</div>
<!-- footer -->
<div class="index-footer"><?php get_footer(); ?></div>
