<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<meta name="description" content="<?php //bloginfo('description'); ?>">-->

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-83976239-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-83976239-1');
		</script>
	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">
			<?php if ( wp_is_mobile() ):  ?>
			
				<div class="flex-mobile">
					<!-- logo -->
						<div class="logo flex-vertical-center">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/img/logo-mob.gif" alt="rcshop.rs" class="logo-img">
							</a>
						</div>
					<!-- /logo -->
					<!-- header-mini-cart -->
					<div class="header-cart">
						<div class="pos-relative">
							<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				 			
							    $count = WC()->cart->cart_contents_count;
							    ?>

							    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('Vidi korpu', 'rcshop'); ?>" > 
							   	<?php 
							    if ( $count > 0 ) {
							        ?>
							      
							        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
							        <span class="basket-not-empty"> <p id="shopcart-txt"> <i class="fas fa-shopping-cart"></i></p> </span>
							    <?php
							   		 } else {
							    ?>
								<span> <p id="shopcart-txt"> <i class="fas fa-shopping-cart"></i></p>  <?php // echo $cart_sum; ?>	</span>
								 <?php
							   		 } 
							    ?>
							    </a>
						 		
							<?php } ?>					
						</div>
					</div>
					<i class="fas fa-bars"></i>
				</div> <!--/flex-mobile-->
				<div class="side-nav">
					<div class="side-nav-inner">
						<div><a href="javascript:void(0)" class="closebtn" >&times;</a></div>
						<div class="mob-cats-nav">
							<div id="cat-mob-toggle">KATEGORIJE</div>
							<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
						</div>
						
						<div class="main-menu">
							
							<!-- nav -->
							<nav class="nav" role="navigation">
								<?php rcshop_nav(); ?>
							</nav>
							<!-- /nav -->
						</div>
							<div class="flex-vertical-center">
								<?php get_template_part('searchform'); ?>
							</div>
						
							<div class="header-account flex-vertical-center">
								<?php $page = get_page_by_title("Moj nalog");?>
									<a href="<?php echo get_permalink( $page->ID ); ?>"> <i class="fas fa-user"></i>
										<?php if (is_user_logged_in()) {
											echo "Moj nalog";
										} else {echo "Prijava/Kreiranje naloga";} ?>								 
									</a>
							</div><!-- /header-account -->					
						
							<div class="header-socials">
								<?php
									$facebook_link = get_field('facebook_link', 'option');
									$twitter_link = get_field('twitter_link', 'option');
									$instagram_link = get_field('instagram_link', 'option');
									$youtube_link = get_field('youtube_link', 'option');
									$google_plus_link = get_field('google_plus_link', 'option');
						
									$phone_number_1 = get_field('phone_number_1', 'option');
									$phone_number_2 = get_field('phone_number_2', 'option');
									//trim strings
									$str = $phone_number_1;
									$str = preg_replace('/\D/', '', $str);
						
									$str2 = $phone_number_2;
									$str2 = preg_replace('/\D/', '', $str2);
								?>
								<?php if(!empty($facebook_link)):  ?>
									<a href="<?php echo $facebook_link; ?>" target="_blank" >
										<i class="fab fa-facebook-f"></i>
									</a>
								<?php endif;  ?>
						
								<?php if(!empty($twitter_link)):  ?>	
									<a href="<?php echo $twitter_link; ?>" target="_blank" >
										<i class="fab fa-twitter"></i>
									</a>
								<?php endif;  ?>	
						
								<?php if(!empty($instagram_link)):  ?>
									<a href="<?php echo $instagram_link; ?>" target="_blank" >
										<i class="fab fa-instagram"></i>
									</a>
								<?php endif;  ?>	
						
								<?php if(!empty($youtube_link)):  ?>
									<a href="<?php echo $youtube_link; ?>" target="_blank" >
										<i class="fab fa-youtube"></i>
									</a>
								<?php endif;  ?>
						
								<?php if(!empty($google_plus_link)):  ?>
									<a href="<?php echo $google_plus_link; ?>" target="_blank" >
										<i class="fab fa-google-plus-g"></i>
									</a>
								<?php endif;  ?>																												
							</div>
						
						
							<div class="header-phones">
								<i class="fas fa-mobile-alt"></i> 
								<span><?php _e('Za više informacija pozovite', 'rcshop'); ?></span>
								
								<?php if(!empty($phone_number_1)):  ?>
									<a href="tel:<?php echo $str; ?>" class="mob-ancor"><?php echo $phone_number_1; ?></a>
								<?php endif;  ?>	
						
								<?php if(!empty($phone_number_2)):  ?>
									<a href="tel:<?php echo $str2; ?>" class="mob-ancor"><?php echo $phone_number_2; ?></a>
								<?php endif;  ?>	
							</div>
						</div><!--/side-nav-inner-->				
					
				</div><!--/side-nav-->
				
			<?php else:  ?>	
				<div class="header-top">
					<div class="container flex">
						<div class="header-socials inline-flex">
							<?php
								$facebook_link = get_field('facebook_link', 'option');
								$twitter_link = get_field('twitter_link', 'option');
								$instagram_link = get_field('instagram_link', 'option');
								$youtube_link = get_field('youtube_link', 'option');
								$google_plus_link = get_field('google_plus_link', 'option');

								$phone_number_1 = get_field('phone_number_1', 'option');
								$phone_number_2 = get_field('phone_number_2', 'option');
								//trim strings
								$str = $phone_number_1;
								$str = preg_replace('/\D/', '', $str);

								$str2 = $phone_number_2;
								$str2 = preg_replace('/\D/', '', $str2);
							?>
							<?php if(!empty($facebook_link)):  ?>
								<a href="<?php echo $facebook_link; ?>" target="_blank" >
									<i class="fab fa-facebook-f"></i>
								</a>
							<?php endif;  ?>

							<?php if(!empty($twitter_link)):  ?>	
								<a href="<?php echo $twitter_link; ?>" target="_blank" >
									<i class="fab fa-twitter"></i>
								</a>
							<?php endif;  ?>	

							<?php if(!empty($instagram_link)):  ?>
								<a href="<?php echo $instagram_link; ?>" target="_blank" >
									<i class="fab fa-instagram"></i>
								</a>
							<?php endif;  ?>	

							<?php if(!empty($youtube_link)):  ?>
								<a href="<?php echo $youtube_link; ?>" target="_blank" >
									<i class="fab fa-youtube"></i>
								</a>
							<?php endif;  ?>

							<?php if(!empty($google_plus_link)):  ?>
								<a href="<?php echo $google_plus_link; ?>" target="_blank" >
									<i class="fab fa-google-plus-g"></i>
								</a>
							<?php endif;  ?>																												
						</div>


						<div class="header-phones inline-flex">
							<i class="fas fa-mobile-alt"></i> 
							<span><?php _e('Za više informacija pozovite', 'rcshop'); ?></span>
							
							<?php if(!empty($phone_number_1)):  ?>
								<a href="tel:<?php echo $str1; ?>" class="mob-ancor"><?php echo $phone_number_1.";"; ?></a>
							<?php endif;  ?>	

							<?php if(!empty($phone_number_2)):  ?>
								<a href="tel:<?php echo $str2; ?>" class="mob-ancor"><?php echo $phone_number_2; ?></a>
							<?php endif;  ?>	
						</div>

					</div><!-- /container -->
				</div><!-- /header-top -->

				<div class="header-middle">
					<div class="container flex">
						<!-- logo -->
						<div class="logo flex-vertical-center">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/img/animirani-rcshop-logo-1.gif" alt="rcshop.rs" class="logo-img">
							</a>
						</div>
						<!-- /logo -->

						<div class="flex-vertical-center">
							<?php get_template_part('searchform'); ?>
						</div>

						<div class="header-account flex-vertical-center">
							<?php $page = get_page_by_title("Moj nalog");?>
								<a href="<?php echo get_permalink( $page->ID ); ?>"> <i class="fas fa-user"></i>
									<?php if (is_user_logged_in()) {
										echo "Moj nalog";
									} else {echo "Prijava/Kreiranje naloga";} ?>								 
								</a>
						</div><!-- /header-account -->

					</div><!-- /container -->
				</div><!-- /header-middle -->

				<div class="header-bottom">
					<div class="container">
						<!-- nav -->
						<nav class="nav" role="navigation">
							<?php rcshop_nav(); ?>
						</nav>
						<!-- /nav -->
					</div>

					<div class="header-cart">
						<div class="pos-relative">
						<!-- header-mini-cart -->
							<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				 			
							    $count = WC()->cart->cart_contents_count;
							    ?>

							    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('Vidi korpu', 'rcshop'); ?>" > 
							  	
							   	<?php 
							    if ( $count > 0 ) {
							        ?>
						        <?php
							    	$cart_sum = WC()->cart->get_cart_total();
							     ?>							      
							        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
							        <span class="basket-not-empty"> <p id="shopcart-txt"> <i class="fas fa-shopping-cart"></i> <?php _e('Korpa', 'rcshop'); ?></p>  <?php  echo $cart_sum; ?>	</span>
							    <?php
							   		 } else {
							    ?>
								
							    
	
							    
							     <span> <p id="shopcart-txt"> <i class="fas fa-shopping-cart"></i> <?php _e('Korpa', 'rcshop'); ?></p>  <?php  echo $cart_sum; ?>	</span>
							     <?php
							   		 } 
							     ?>
							    </a>
						 		<div class="minicart-dropdown"><?php  //woocommerce_mini_cart(); ?> </div>
							<?php } ?>
						</div>
					</div>
				</div><!-- /header-bottom -->
				
				<?php endif;  ?>
			</header>
			<!-- /header -->

			<div class="body-content">
			<?php if(!is_front_page() && !is_product_category() && !is_product()):  ?>	
			<div class="breadcrumb">
				<div class="container"><?php the_breadcrumb(); ?> </div>
			</div>
			<?php endif;  ?>	

			<?php if(is_product_category() || is_product()):  ?>	
				<?php
					$args = array(
							'delimiter' => '>',
							'wrap_before' => '<span class="woo-bread-wrap">',
							'wrap_after' => '</span>',
							'before' => '<span>',
							'after' => '</span>',
					);
				?>
			<div class="breadcrumb">
				<div class="container"><?php woocommerce_breadcrumb($args); ?> </div>
			</div>
			<?php endif;  ?>	