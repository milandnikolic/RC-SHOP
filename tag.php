<?php  get_header(); 

	$blog_cover_image = get_field('blog_cover_image', 'option');
?>

									
	<?php if( !empty($blog_cover_image) ): ?>								
	<div class="img-banner">
		<img class="img-fit" src="<?php echo $blog_cover_image['url']; ?>" alt="<?php echo $blog_cover_image['alt']; ?>" />
		<div class="align-center">
			<h1 class="white text-uppercase page-title"><?php _e( 'Tag: ', 'rcshop' ); echo single_tag_title('', false); ?></h1>		
		</div>													
	</div>
	<?php endif; ?>


	<div class="blog-post-wrapper">
		<div class="container">
			<div class="row">
				<div class="col8">
					<div class="row">
						<?php get_template_part('loop'); ?>					
					</div><!--  /row -->
				</div>
				<div class="col4">
					<?php get_sidebar(); ?>
				</div>
			</div><!--  /row -->
		</div><!--  /container -->
	</div>



<?php get_footer(); ?>


<?php //get_template_part('loop'); ?>

			<?php //get_template_part('pagination'); ?>

