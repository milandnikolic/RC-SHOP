<?php 
	//vars
	$phone_number_1 = get_field('phone_number_1' , 'option');
	$phone_number_2 = get_field('phone_number_2' , 'option');
	$company_name = get_field('company_name' , 'option');
	$address = get_field('address' , 'option');
	$email_1 = get_field('email_1' , 'option');
	$email_2 = get_field('email_2' , 'option');
	$skype = get_field('skype' , 'option');

	//trim strings
	$str = $phone_number_1;
	$str = preg_replace('/\D/', '', $str);

	$str2 = $phone_number_2;
	$str2 = preg_replace('/\D/', '', $str2);
?>
			</div><!-- /body-content -->
			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="footer-top">
					<div class="container text-center">
						<!-- Begin MailChimp Signup Form -->
						<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">

						<div id="mc_embed_signup">
						<form action="https://rcshop.us11.list-manage.com/subscribe/post?u=dd572c632c75baaa87287aca7&amp;id=235eb42aaa" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						    <div id="mc_embed_signup_scroll">
							<label for="mce-EMAIL" class="white text-uppercase"><?php _e('Prijavi se za newsletter', 'rcshop'); ?></label>
							<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Unesite vašu email adresu" required>
						    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dd572c632c75baaa87287aca7_235eb42aaa" tabindex="-1" value=""></div>
						    <div class="clear"><input type="submit" value="PRIJAVI SE" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						    </div>
						</form>
						</div>

						<!--End mc_embed_signup-->
					</div>
				</div>

				<div class="footer-middle">
					<div class="container">
						<div class="row">
							<div class="col6">
								<h5 class="white text-uppercase">rcshop</h5>
								<p><?php _e('RC Shop je prodavnica modela na daljinsko upravljanje, modela aviona, multikoptera, helikoptera, automobila, brodova...  U našoj prodavnici možete naći i opremu za snimanje iz vazduha, GoPro program, rezervne delove, dodatnu opremu, LiPO i NiMH baterije i gorivo za vaše modele.
									Oprema za snimanje iz vazduha još jedna je od naših specijalnosti.
									Naša prodavnica zastupa na srpskom tržištu nekoliko poznatih svetskih brendova kao što su: Gens Ace Li Po baterije, BASECAM AlexMos elektroika za stabilizaciju gimblova, SkyRC napajanja i punjači, DYS gimblovi i servo motori, AMMAS konektori i silikonske žice, NiceSky modeli aviona.
									Pored brendova koje zastupamo RC shop saradjuje i sa Horizon hobby, DJI multikopteri, dronovi, Phantom, Zenmuse kontrolori leta i rezervni delovi, Tattu baterije za multikoptere i dronove.', 'rcshop'); ?>
										
								</p>
							</div>

							<div class="col3 middle-col">
								<div>
								<h5 class="white text-uppercase"><?php _e('korisnički meni', 'rcshop'); ?></h5>
								<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
								</div>
								
								<div>
								<h5 class="white text-uppercase"><?php _e('pratite nas', 'rcshop'); ?></h5>
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
							</div>

							</div>
							<div class="col3">
								<h5 class="white text-uppercase"><?php _e('kontakt', 'rcshop'); ?></h5>
								<?php if(!empty($company_name)):  ?>
									<p><?php echo $company_name; ?></p>
								<?php endif;  ?>

								<?php if(!empty($address)):  ?>
									<p><i class="fas fa-home"></i> <?php echo $address; ?></p>
								<?php endif;  ?>

								<?php if(!empty($phone_number_1)):  ?>
									<p><a href="tel:<?php echo $str; ?>" class="mob-ancor"><i class="fas fa-phone"></i> <i class="fab fa-viber"></i> <?php echo $phone_number_1; ?></a></p>
								<?php endif;  ?>

								<?php if(!empty($phone_number_2)):  ?>
									<p><a href="tel:<?php echo $str2; ?>" class="mob-ancor"><i class="fas fa-phone"></i> <i class="fab fa-viber"></i> <?php echo $phone_number_2; ?></a></p>
								<?php endif;  ?>

								<?php if(!empty($email_1)):  ?>
									<p><a href="mailto:<?php echo $email_1; ?>" class="mob-ancor"><i class="fas fa-envelope"></i> <?php echo $email_1; ?></a></p>
								<?php endif;  ?>

								<?php if(!empty($email_2)):  ?>
									<p><a href="mailto:<?php echo $email_2; ?>" class="mob-ancor"><i class="fas fa-envelope"></i> <?php echo $email_2; ?></a></p>
								<?php endif;  ?>

								<?php if(!empty($skype)):  ?>
									<p><i class="fab fa-skype"></i> <?php echo $skype; ?></p>
								<?php endif;  ?>
								
								<?php 
									if (is_user_logged_in() && current_user_can('administrator') ) {
										echo '<p><b>PIB:</b> 108933910</p>';
										echo '<p><b>Matični broj:</b> 21096016</p>';
									}
								?>
							</div>

							<div class="col12">
								<div class="text-center">
									<!--<img src="<?php //echo get_template_directory_uri(); ?>/img/master1.jpg" alt="Master">
									<img src="<?php //echo get_template_directory_uri(); ?>/img/visa1.jpg" alt="Visa">
									<img src="<?php //echo get_template_directory_uri(); ?>/img/maestro1.jpg" alt="Maestro">
									<img src="<?php //echo get_template_directory_uri(); ?>/img/american-express.jpg" alt="American Express">
									<a href="http://www.bancaintesa.rs/pocetna.1.html"><img src="<?php //echo get_template_directory_uri(); ?>/img/banca-intesa.jpg" alt="Banca Intesa"></a>
									<a href="https://rs.visa.com/"><img src="<?php //echo get_template_directory_uri(); ?>/img/visa-verified.jpg" alt="Visa"></a>
									<a href="https://www.mastercard.us/en-us.html"><img src="<?php //echo get_template_directory_uri(); ?>/img/sclogo.jpg" alt="Secure Code"></a>-->
<div class="master1"></div>		
<div class="visa1"></div>
<div class="maestro1"></div>	
<div class="american-express"></div>	
	<a href="http://www.bancaintesa.rs/pocetna.1.html">	<div class="banca-intesa"></div></a>	
	<a href="https://rs.visa.com/"><div class="visa-verified"></div></a>			
<a href="https://www.mastercard.us/en-us.html"><div class="sclogo"></div></a>





							</div>
								<p class="text-center info">Sve cene na ovom sajtu iskazane su u dinarima. PDV je uračunat u cenu. Aerial Video Solutions doo maksimalno koristi sve svoje resurse da Vam svi artikli na ovom sajtu budu prikazani sa ispravnim nazivima specifikacija, fotografijama i cenama. Ipak, ne možemo garantovati da su sve navedene informacije i fotografije artikala na ovom sajtu u potpunosti ispravne.</p>
								<div class="text-center">
									<a href='https://www.rcshop.rs/trust'><img src='https://verify.etrustmark.rs/cert/image.php' target="_blank"></a>
									<span><div id="thawteseal" style="text-align:center;" title="Click to Verify - This site chose Thawte SSL for secure e-commerce and confidential communications.">
									<div><script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=rcshop.rs&amp;size=S&amp;lang=en"></script></div>
									<div><a href="http://www.thawte.com/ssl-certificates/" target="_blank" style="color:#fff; text-decoration:none; font:bold 10px arial,sans-serif; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></div>
									</div></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="footer-bottom">
					<div class="container">
						<p class="copyright text-center">
						<?php _e('Copyright &copy; 2016 - Zabranjeno kopiranje i korišćenje elemenata sajta bez odobrenja. Sva prava zadržava Aerial Video Solutions doo, Niš', 'rcshop'); ?>
						</p>
					</div>
				</div>

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

		<?php wp_footer(); ?>



	</body>
</html>
