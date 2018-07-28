<?php /* Template Name: Home */ get_header(); 
	//vars
	$slide = get_field('slider');

?>

<?php if( have_rows('slider') ): ?>

<div class="slider-container">
	<div class="slider">

	<?php while( have_rows('slider') ): the_row(); 

		// vars
		$image = get_sub_field('slider_image');
		$slider_logo = get_sub_field('slider_logo');
		$title = get_sub_field('slider_title');
		$title2 = get_sub_field('slider_subtitle');
		$title3 = get_sub_field('slider_text');
		$button = get_sub_field('slider_button');
		$link = get_sub_field('button_link');
		$font_color = get_sub_field('font_color');
		$background_color = get_sub_field('background_color');
		$slider_mob_img = get_sub_field('slider_mob_img');

	?>
		<?php if( !wp_is_mobile() ): ?>
		<div class="slide-item" style="background-image:url(<?php echo $image['url']; ?>); background-color:<?php echo $background_color; ?>;">
		<?php else: ?>
		<div class="slide-item" style="background-image:url(<?php echo $slider_mob_img['url']; ?>); background-color:<?php echo $background_color; ?>;">	
		<?php endif; ?>	
				
						<div class="container">
						
								<div class="align-center text-center">
									<?php if( !empty($slider_logo) ): ?>
									<img data-animation="fadeInUp" data-delay="0.1s" src="<?php echo $slider_logo['url']; ?>" alt="<?php echo $slider_logo['alt']; ?>" />
									<?php endif; ?>

									<?php if( $title ): ?>
									<h2 class="white mgb-0" data-animation="fadeInUp" data-delay="0.2s" style="color:<?php echo $font_color; ?>!important;"><?php echo $title; ?></h2>
									<?php endif; ?>
									
									<?php if( $title2 ): ?>
										<h4 class="white" data-animation="fadeInUp" data-delay="0.33s" style="color:<?php echo $font_color; ?>!important;"> <?php echo $title2; ?></h4>
									<?php endif; ?>

									<?php if( $title3 ): ?>
										<p class="white"  data-animation="fadeInUp" data-delay="0.53s" style="color:<?php echo $font_color; ?>!important;"> <?php echo $title3; ?></p>
									<?php endif; ?>
									
									<?php if( $button ): ?>
									<a href="<?php echo $link; ?>" class="white-bg sld-btn"  data-animation="fadeInUp" data-delay="0.83s">
										<?php echo $button; ?>
									</a>
									<?php endif; ?>
								
								</div>
							
						</div>
				
			
		</div>


	<?php endwhile; ?>
	</div>
</div> <!--end of slider container-->
<?php endif; ?>

<div class="main-section">
	<div class="container">
		<?php if ( !wp_is_mobile() ):  ?>
		<div class="row">
		<?php endif; ?>
			<?php if ( !wp_is_mobile() ):  ?>
			<div class="col3 menu-side">
				<h3 class="text-uppercase">kategorije</h3>
				<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
			</div>
			<?php endif; ?>

			<?php if ( wp_is_mobile() ):  ?>
				<?php echo do_shortcode( '[products limit="6" columns="3" visibility="featured" ]' ); ?>	
			<?php else: ?>
			<div class="col9">
				<div class="row">
					<?php echo do_shortcode( '[products limit="6" columns="3" visibility="featured" ]' ); ?>
				</div>
			<?php endif; ?>
			</div>
		<?php if ( !wp_is_mobile() ):  ?>
		</div>
		<?php endif; ?>
	</div>
</div>

<div id="home-text-section">
	<div class="container">
		<div class="row">
			<div class="col3 text-center">
				<i class="fas fa-shopping-basket"></i>
				<h3 class="text-uppercase">rcshop.rs prodavnica</h3>
				<p><b>rcshop</b> – prodaja originalnih modela, poznatih brendova, povoljne cene. Kupite originalni model sa garancijom i računom.</p>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-lock"></i>
				<h3 class="text-uppercase">garancija</h3>
				<p>Svi proizvodi kupljeni u našoj prodavnici imaju garanciju proizvodjača i fiskalni račun. Budite sigurni pri kupovini.</p>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-handshake"></i>
				<h3 class="text-uppercase">Tehnička podrška</h3>
				<p>Besplatna tehnička podrška za sve proizvode kupljene u našoj radnji. Stručnu pomoć možete pronaći na forumu</p>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-truck"></i>
				<h3 class="text-uppercase">Dostava kurirskom službom</h3>
				<p><b>rcshop</b> – vrši isporuku kupljene robe kurirskom službom na teritoriji Republike Srbije. Sva kupljena roba biće isporučena kupcu za najviše 7 radna dana.</p>
			</div>
		</div>
	</div>
</div>


<div id="home-products">
	<div class="container">
		<h2 class="text-center text-uppercase"><span class="section-title">Proizvodi na akciji</span></h2>
		<!-- <div class="row"> -->

			<?php echo do_shortcode( '[products limit="4" columns="4" on_sale="true" orderby="date" order="DESC" class="on-sale" ]' ); ?>
		<!-- </div> -->
	</div>
</div>



<?php get_footer(); ?>