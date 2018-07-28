<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>
			<div class="container">
			<!-- article -->
			<article id="post-404">

				<h1 class="text-center"><?php _e( 'Ova stranica ne postoji', 'rcshop' ); ?></h1>
				<h2 class="text-center">
					<a href="<?php echo home_url(); ?>"><?php _e( 'Vratite se na naslovnu?', 'rcshop' ); ?></a>
				</h2>

			</article>
			<!-- /article -->
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
