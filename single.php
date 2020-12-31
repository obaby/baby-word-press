<?php get_header(); ?>

<!-- 自定义wp_link_pages分页样式开始 -->
<style>
#block-nav a.post-page-numbers, #block-nav .post-page-numbers ,#block-nav .link-pages{
    font-size: 1.0em;
    border: 1px solid;
    padding: 5px 10px;
    background: white;
    color: black;
    transition: 0.3s;
}
#block-nav span.post-page-numbers.current {
    color: white;
    background: black;
    border: 1px solid black;
}
#block-nav a.post-page-numbers:hover {
    background-color: black;
    color: #ffffff;
}
</style>
<!-- 自定义wp_link_pages分页样式结束 -->

<div class="row">

	<div class="col-lg-8 col-12">
		<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<div class="row">
				<div class="col-12">

					<?php while ( have_posts() ) : the_post(); ?>
						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

							<div class="entry-meta entry-meta-top">
								<p class="entry-categories">
									<?php the_category( ', ' ); ?>
								</p>
							</div>

							<h1 class="entry-title" itemprop="headline">
								<?php the_title(); ?>
							</h1>

							<div class="entry-meta entry-meta-bottom">
								<time class="entry-date" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

								<a href="<?php echo esc_url( get_comments_link() ); ?>" class="entry-comments-no "><?php comments_number(); ?></a>
							</div>

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="entry-featured">
									<a class="ci-lightbox" href="<?php echo esc_url( olsen_light_get_image_src( get_post_thumbnail_id(), 'large' ) ); ?>">
										<?php the_post_thumbnail( 'post-thumbnail', array( 'itemprop' => 'image' ) ); ?>
									</a>
								</div>
							<?php endif; ?>


							<div class="entry-content" itemprop="text">
								<?php the_content(); ?>
								<!-- 自定义wp_link_pages分页样式开始 -->
								<br>	
								<div id="block-nav"><?php wp_link_pages('before="文章分页：" &after=....'); ?></div>
								<!-- 自定义wp_link_pages分页样式结束 -->
							</div>

							<div class="entry-tags">
								<?php the_tags( '', '' ); ?>
							</div>

							<div class="entry-utils group">
								<?php get_template_part( 'part', 'social-sharing' ); ?>
							</div>

							<div id="paging" class="group">
								<?php
									$prev_post = get_previous_post();
									$next_post = get_next_post();
								?>
								<?php if( ! empty( $next_post ) ): ?>
									<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="paging-standard paging-older"><?php esc_html_e( 'Previous Post', 'olsen-light' ); ?></a>
								<?php endif; ?>
								<?php if( ! empty( $prev_post ) ): ?>
									<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="paging-standard paging-newer"><?php esc_html_e( 'Next Post', 'olsen-light' ); ?></a>
								<?php endif; ?>
							</div>

							<?php get_template_part( 'part', 'related' ); ?>

							<?php comments_template(); ?>

						</article>
					<?php endwhile; ?>
				</div>
			</div>
		</main>
	</div>

	<div class="col-lg-4 col-12">
		<?php get_sidebar(); ?>
	</div>

</div><!-- /row -->

<?php get_footer(); ?>
