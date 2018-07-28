<?php /* Template Name: Blog page */ get_header(); 

	$blog_cover_image = get_field('blog_cover_image', 'option');
?>

									
	<?php if( !empty($blog_cover_image) ): ?>								
	<div class="img-banner">
		<img class="img-fit" src="<?php echo $blog_cover_image['url']; ?>" alt="<?php echo $blog_cover_image['alt']; ?>" />
		<div class="align-center">
			<h1 class="white text-uppercase page-title"><?php _e('blog', 'rcshop'); ?></h1>		
		</div>													
	</div>
	<?php endif; ?>


	<div class="blog-post-wrapper">
		<div class="container">
			<div class="row">
				<div class="col8">
					<div class="row post-items">
					<?php		
						$args = array(
							'post_type'		 => 'post',
							'posts_per_page' => 1,
							'orderby'		 =>	'date',
							'order'			 =>  'DESC',
						);
						$the_query = new WP_Query( $args ); 
					?>	
					<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col12">
							<div class="post-item">
									<!-- post thumbnail -->
									<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<div class="img-wrap">
												<?php the_post_thumbnail(array( 400, 400), ['class' => 'img-fit']); ?>
												<figcaption>
												    <div><i class="fas fa-link"></i></div>
												 </figcaption>
											</div>					
										</a>
									<?php endif; ?>
									<!-- /post thumbnail -->

									<div class="post-body">
										<div class="flex">
											<span class="date"><?php the_time('F j, Y'); ?></span>
											<div class="tags-wrapper"><?php the_tags( __( '', 'rcshop' ), ' ');  ?></div>
										</div>
										
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<h2><?php the_title(); ?></h2>
										</a>

									</div>
							</div><!--  /post-item -->							
						</div>
					<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>


					<?php		
						$args = array(
							'post_type'		 => 'post',
							'posts_per_page' => 6,
							'orderby'		 =>	'date',
							'order'			 =>  'DESC',
							'offset'         =>  1,
							'paged'          => 1,
							'post_status'    => 'publish',
						);
						$the_query = new WP_Query( $args ); 
					?>	
					<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="col6">
								<div class="post-item">
									<!-- post thumbnail -->
									<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<div class="img-wrap">
												<?php the_post_thumbnail(array( 400, 400), ['class' => 'img-fit']); ?>
												<figcaption>
												    <div><i class="fas fa-link"></i></div>
												 </figcaption>
											</div>					
										</a>
									<?php endif; ?>
									<!-- /post thumbnail -->

									<div class="post-body">
										<div class="flex">
											<span class="date"><?php the_time('F j, Y'); ?></span>
											<div class="tags-wrapper"><?php the_tags( __( '', 'rcshop' ), ' ');  ?></div>
										</div>
										
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<h2><?php the_title(); ?></h2>
										</a>

									</div>
								</div><!--  /post-item -->
							</div><!--  /col6 -->

							
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					
					</div><!--  /row -->
				</div>
				<div class="col4">
					<?php get_sidebar(); ?>
				</div>
			</div><!--  /row -->
		</div><!--  /container -->
	</div>



<script type="text/javascript">
/*var ajaxurl = "<?php //echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
	jQuery('body').on('click', '.loadmore', function() {
		var data = {
			'action': 'load_posts_by_ajax',
			'page': page,
			'security': '<?php //echo wp_create_nonce("load_more_posts"); ?>'
		};

		$.post(ajaxurl, data, function(response) {
			jQuery('.my-posts').append(response);
			page++;
		});
	});
});*/


var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;

jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()) {
			var data = {
				'action': 'load_posts_by_ajax',
				'page': page,
				'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
			};

			jQuery.post(ajaxurl, data, function(response) {
				jQuery('.post-items').append(response);
				page++;
			});
		}
	});
</script>

<?php get_footer(); ?>


<?php //get_template_part('loop'); ?>

			<?php //get_template_part('pagination'); ?>