<?php
/**
 * Front page template file
 * This is the generic template file in a WordPress theme.
 *
 * @link https://kodna.net/
 *
 * @package WordPress
 * @subpackage MetaKata
 * @since 0
*/
get_header();
?>
<div class="content-area">
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
<!-- content section -->
<div class="callout-text"> <?php echo get_theme_mod('callout-custom-text') ?></div>
<div class="realm">
<div id='canvas'>
</div>
</div>
<div class="posts_area"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="post" role="article" itemscope itemtype="http://schema.org/Article">
<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
<div class="post_meta"><time class="post_date" datetime="<?php the_time('Y-m-d'); ?>"itemprop="datePublished"><?php the_time(__('F j, Y')); ?></time></div>
<div class="postcontent_list" itemprop="articleBody" data-type-cleanup="true"><?php the_content('Read More &raquo;'); ?></div>
</article>
<?php endwhile; endif; ?>
<div class="nav_links"><?php posts_nav_link(); ?></div>
</div>
</main>
</div>
<!-- footer -->
<div class="front-page-footer"><?php get_footer(); ?></div>
