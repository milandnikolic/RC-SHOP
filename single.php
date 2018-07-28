<?php get_header(); 

	$blog_cover_image = get_field('blog_cover_image', 'option');
	$single_post_products = get_field('single_post_products', 'option');
?>

									
	<?php if( !empty($blog_cover_image) ): ?>								
	<div class="img-banner">
		<img class="img-fit" src="<?php echo $blog_cover_image['url']; ?>" alt="<?php echo $blog_cover_image['alt']; ?>" />
		<div class="align-center">
			<h4 class="blog-subtitle white text-uppercase"><?php _e('blog', 'rcshop'); ?></h4>
			<h1 class="white text-capitalize page-title"><?php the_title(); ?></h1>		
		</div>													
	</div>
	<?php endif; ?>

	<!-- section -->
	<section>
	
	<div class="container">
		<div class="row">
			<div class="col8 sinle-post-wrapper">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
							<div class="single-post-img"><?php the_post_thumbnail(); ?>	</div>					
					<?php endif; ?>
					<!-- /post thumbnail -->

					<div class="flex single-post-data">
						<!-- post details -->
						<span class="date"><?php the_time('F j, Y'); ?></span>
						<span class="author"><?php _e( 'Napisao:', 'rcshop' ); ?> <b><?php the_author_posts_link(); ?></b></span>
						<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Ostavite svoj komentar', 'rcshop' ), __( '1 Komentar', 'rcshop' ), __( '% Komentara', 'rcshop' )); ?></span> 
						<div class="tags-wrapper"><?php the_tags( __( '', 'rcshop' ), ' ');  ?></div>
						
						<!-- /post details -->
					</div>
					<?php the_content(); // Dynamic Content ?>


					<div class="single-post-products">
						<h3 class="text-center text-uppercase">preporučujemo <i class="far fa-thumbs-up"></i></h3>
						<?php echo do_shortcode('[products limit="3" columns="3" ids="'.$single_post_products.'" ]'); ?>
					</div>

					<?php comments_template(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

		<?php endif; ?>				
			</div>
			<div class="col4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

	</section>
	<!-- /section -->




<?php get_footer(); ?>
