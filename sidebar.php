<?php 
	//vars
	$blog_posts = get_field('featured_posts_in_sidebar', 'option');
?>

<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<?php if ( (is_single() || is_home() || is_category() || is_tag()) && !is_product() ) : ?>

		<div class="sidebar-widget">
			<?php $postid = get_the_ID(); ?>
			<?php if( $blog_posts ): ?>
				<h2 class="sidebar-title text-uppercase"><?php _e('istaknuti postovi', 'rcshop'); ?></h2>
				<div class="sidebar-posts">
				<?php $do_not_duplicate = $post->ID; ?>
				<?php foreach( $blog_posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
					<?php
						if ($p->ID != $postid) :
					?>
					<a href="<?php echo get_permalink( $p->ID ); ?>">
				    <div class="post-item">
				    	<?php echo get_the_post_thumbnail( $p->ID, array( 200, 200), ['class' => 'img-fit']); ?>
				    	<div class="sidebar-overlay"><h3><?php echo get_the_title( $p->ID ); ?></h3></div>
				    </div>
				    </a>
				    <?php endif; ?>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
		</div>

	<?php elseif( ( is_product() || is_product_category() || is_product_tag() || is_page('proizvodi-na-akciji') ) && !wp_is_mobile() ): ?>

		<div class="sidebar-widget menu-side">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
		</div>

	<?php endif; ?>

</aside>
<!-- /sidebar -->
