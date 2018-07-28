<?php /* Template Name: On sale page */ get_header(); ?>
	<!-- post thumbnail -->
	<?php if ( has_post_thumbnail()) :  ?>
	<div class="img-banner">
					
				<?php the_post_thumbnail('full', ['class' => 'img-fit']); ?>			
			
		<div class="align-center"><h1 class="white page-title"><?php the_title(); ?></h1></div>
	</div>
	<?php else: ?>
		<h1 class="text-center page-title"><?php the_title(); ?></h1>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col3">
				<?php get_sidebar(); ?>
			</div>
			<div class="col9">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<div class="content-wrapper">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>				
			</div>
		</div>

	</div>

<?php get_footer(); ?>