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
<!-- footer -->
<?php get_footer();
