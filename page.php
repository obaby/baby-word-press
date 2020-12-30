<?php get_header(); ?>
<div class="row">
<?php if (bp_is_blog_page()): ?>
<div class="col-lg-8 col-12">
<?php else: ?>
<div class="col-lg-12 col-12">
<?php endif; ?>
<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="row">
<div class="col-12">
<?php while ( have_posts() ) : the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
<h2 class="entry-title" itemprop="headline">
<?php the_title(); ?>
</h2>
<?php if ( has_post_thumbnail() ) : ?>
<div class="entry-featured">
<a class="ci-lightbox" href="<?php echo esc_url( olsen_light_get_image_src( get_post_thumbnail_id(), 'large' ) ); ?>">
<?php the_post_thumbnail( 'post-thumbnail', array( 'itemprop' => 'image' ) ); ?>
</a>
</div>
<?php endif; ?>
<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages(); ?>
</div>
<div class="entry-utils group">
<?php get_template_part( 'part', 'social-sharing' ); ?>
</div>
<?php comments_template(); ?>
</article>
<?php endwhile; ?>
</div>
</div>
</main>
</div>
<?php if (bp_is_blog_page()): ?>
<div class="col-lg-4 col-12">
<?php else: ?>
<div>
<?php endif; ?>
<?php if (bp_is_blog_page()){
            get_sidebar();
            }
        ?>
</div>
</div>
<?php get_footer(); ?>
</div></div>