<?php
/**
 * Index page template file
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
<div id="primary" class="content-area">
<div class="nullcanvas" id="canvas"></div>
<div class="index_posts_area">
<div class="woocommerce-area"><?php woocommerce_content(); ?>
</div>
</div>
</div>
</main>
<!-- footer -->
<?php get_footer();
