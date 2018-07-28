<?php /* Template Name: Contact page */ get_header(); 
	//vars
	//$slide = get_field('slider');

?>

	<!-- post thumbnail -->
	<?php if ( has_post_thumbnail()) :  ?>
	<div class="img-banner">
					
				<?php the_post_thumbnail('full', ['class' => 'img-fit']); ?>			
			
		<div class="align-center"><h1 class="white page-title"><?php the_title(); ?></h1></div>
	</div>
	<?php else: ?>
		<h1 class="text-center page-title"><?php the_title(); ?></h1>
	<?php endif; ?>

	
	<div class="container-narrow">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>	
		<div class="content-wrapper">
			<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
	<?php endif; ?>
		
	</div><!-- /container-narrow -->

<div class="contact-data-wrapper">
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
	<div class="container">
		<div class="row">
			<div class="col12">
				<h2 class="text-center">Kontakt podaci</h2>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-home"></i>
				<?php if(!empty($company_name)):  ?>
					<h4><?php echo $company_name; ?></h4>
				<?php endif;  ?>

				<?php if(!empty($address)):  ?>
					<h5><?php echo $address; ?></h5>
				<?php endif;  ?>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-phone-square"></i>
				<?php if(!empty($phone_number_1)):  ?>
					<h4><a href="tel:<?php echo $str; ?>" class="mob-ancor"><?php echo $phone_number_1; ?></a> </h4>
				<?php endif;  ?>

				<?php if(!empty($phone_number_2)):  ?>
					<p><a href="tel:<?php echo $str2; ?>" class="mob-ancor"><?php echo $phone_number_2; ?></a> </p>
				<?php endif;  ?>
			</div>
			<div class="col3 text-center">
				<i class="fas fa-envelope"></i>
				<?php if(!empty($email_1)):  ?>
					<p class="mg5">Podrška kupcima: <a href="mailto:" class="mob-ancor"><?php echo $email_1; ?></a> </p>
				<?php endif;  ?>

				<?php if(!empty($email_2)):  ?>
					<p>Povraćaj robe i refundacija: <a href="mailto:" class="mob-ancor"><?php echo $email_2; ?></a> </p>
				<?php endif;  ?>
			</div>
			<div class="col3 text-center">
				<i class="far fa-clock"></i>
				<h4>Ponedeljak - Petak</h4>
				<h5>09 - 15h</h5>
			</div>
		</div>
		
	</div>
</div>


<div id="maps">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8448.801783432667!2d21.885733757991126!3d43.33381786185875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4755b7319e54842b%3A0x22b778428cc67dd0!2sAerial+Video+Solutions+doo%2C+Ni%C5%A1!5e0!3m2!1sen!2srs!4v1529962697485" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>



<?php get_footer(); ?>