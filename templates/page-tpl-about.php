<?php /* Template Name: About us page */ get_header(); 
	//vars
	$main_subtitle = get_field('main_subtitle');

?>
	<!-- post thumbnail -->
	<?php if ( has_post_thumbnail()) :  ?>
	<div class="img-banner">
					
				<?php the_post_thumbnail('full', ['class' => 'img-fit']); ?>			
			
		<div class="align-center text-center">
			<h1 class="white page-title"><?php the_title(); ?></h1>
			<h3 class="white describe-text"><em><?php echo $main_subtitle; ?> </em></h3>
		</div>
	</div>
	<?php else: ?>
		<h1 class="text-center page-title"><?php the_title(); ?></h1>
	<?php endif; ?>

	<div class="container">
			<?php if( have_rows('additional_descs') ): ?>
			
					<?php $count = 0; ?>
					<?php while( have_rows('additional_descs') ): the_row(); 

						// vars
					/*	$description_text = get_sub_field('description_text');
						$description_image = get_sub_field('description_image');					
					    $desciption_title = get_sub_field('desciption_title');*/
					?>
					
					
					<div class="add_desc">
						<div class="row">
						<?php if( $count > 0 && ($count % 2 != 0) ): ?>
							<div class="col6 about-img">
								<img src="<?php echo $description_image['url']; ?>" alt="<?php echo $description_image['alt']; ?>" class="img-fit" />
							</div>
						<?php else: ?>		
													
							
							<div class="col6 align-center-left">
								<div><?php echo $add_desc; ?></div>
							</div>
						<?php endif; ?>	
						
						<?php if( $count > 0 && ($count % 2 != 0) ): ?>	
							<div class="col6 align-center-left">
								<?php if( !empty($desciption_title)) ): ?>	
									<h2 class="text-uppercase"><?php echo $desciption_title; ?></h2>
								<?php endif; ?>	
								<div><?php echo $description_text; ?></div>
							</div>
							
						<?php  else: ?>		
							<div class="col6 about-img">
								<img src="<?php echo $description_image['url']; ?>" alt="<?php echo $description_image['alt']; ?>" class="img-fit" />
							</div>	
						<?php endif; ?>	
						</div>
					</div>						

					
	
					 <?php $count++;  ?>
					 
					<?php endwhile; ?>
				
			<?php endif; ?>
	</div>


<?php get_footer(); ?>