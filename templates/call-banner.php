<?php 
	//vars
	$phone_number_1 = get_field('phone_number_1' , 'option');
	$phone_number_2 = get_field('phone_number_2' , 'option');


	//trim strings
	$str = $phone_number_1;
	$str = preg_replace('/\D/', '', $str);

	$str2 = $phone_number_2;
	$str2 = preg_replace('/\D/', '', $str2);
?>
<div class="btn" id="call-banner">
	<h2 class="white txt-center">Pozovite za više informacija!</h2>
	<div class="text-center">
		<?php if(!empty($phone_number_1)):  ?>
			<a href="tel:<?php echo $str; ?>" class="mob-ancor"><i class="fas fa-phone"></i>  <?php echo $phone_number_1; ?> <i class="fab fa-viber"></i></a>
		<?php endif;  ?>
	</div>
</div>