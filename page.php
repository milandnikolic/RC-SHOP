<?php get_header(); ?>
	<!-- post thumbnail -->
	<?php if ( has_post_thumbnail()) :  ?>
	<div class="img-banner">
					
				<?php the_post_thumbnail('full', ['class' => 'img-fit']); ?>			
			
		<div class="align-center"><h1 class="white page-title"><?php the_title(); ?></h1></div>
	</div>
	<?php else: ?>
		<h1 class="text-center page-title"><?php the_title(); ?></h1>
	<?php endif; ?>
		
	

	
<?php $click_to_activate_sidebar = get_field('click_to_activate_sidebar');
	// check
	if( !$click_to_activate_sidebar ): ?>
	<?php if( is_checkout() ): ?>
	<div class="container">
	<?php else: ?>
	<div class="container-narrow">
	<?php endif; ?>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<div class="content-wrapper">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- /container-narrow -->
<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col4">
				<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
			</div>
			<div class="col8">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<div class="content-wrapper">
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- /container -->

<?php endif; ?>

<?php get_footer(); ?>
