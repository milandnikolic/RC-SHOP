<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>
		
			<div class="container">
			<?php //woocommerce_breadcrumb(); ?>
				
			<?php if ( is_product_category() ){
				
			    global $wp_query;

			    // get the query object
			    //$cat = $wp_query->get_queried_object();

				// get the thumbnail id using the queried category term_id
				//$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
				// vars
				$queried_object = get_queried_object(); 
				$taxonomy = $queried_object->taxonomy;
				$term_id = $queried_object->term_id;  
				$top_banner_image = get_field( 'top_banner_image', $queried_object );
				$top_banner_image = get_field( 'top_banner_image', $taxonomy . '_' . $term_id );


			    //if($thumbnail_id){
			    if( get_field('top_banner_image', $taxonomy . '_' . $term_id) ) {
			    	echo "<div class='img-banner'>";
				    // get the image URL
				    //$image = wp_get_attachment_url( $thumbnail_id ); 
				    
				    // print the IMG HTML
				    //echo "<img src='{$image}' class='img-fit'  />";
				    echo '<img src="'.$top_banner_image.'" class="img-fit" />';
				     //echo wp_get_attachment_image( $top_banner_image, $size );

				    $term_name = single_cat_title('<h1 class="main-cat-title"><b>');
					    	echo $term_name;
				    echo "</b></h1></div>";
			    }
			   
			} ?>
				
				<div class="row">
					<?php if (is_shop()): ?>
						<div class="col12"><?php woocommerce_content(); ?></div>	
					<?php else: ?>
						<div class="col3"><?php get_sidebar(); ?></div>
					

						<div class="col9"><?php woocommerce_content(); ?></div>					
					<?php endif; ?>	
				</div>
			</div>
			
		</section>
		<!-- /section -->
	</main>



<?php get_footer(); ?>
