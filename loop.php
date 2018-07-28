<?php if (have_posts()): while (have_posts()) : the_post(); ?>

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
						</div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'rcshop' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
