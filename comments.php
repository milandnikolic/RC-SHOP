<div class="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'rcshop' ); ?></p>
</div>

	<?php return; endif; ?>

<?php if (have_comments()) : ?>

	<h2><?php comments_number(); ?></h2>

	<ul>
		<?php wp_list_comments('type=comment&callback=rcshopcomments'); // Custom callback in functions.php ?>
	</ul>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p><?php _e( 'Komentari su zatvoreni.', 'rcshop' ); ?></p>

<?php endif; ?>

<?php
$aria_req = "";
$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			
			'author' =>'<div class="row"><div class="comment-form-author col6">' . '<input id="author" placeholder="Vaše ime" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
				
		
				'</div>'
				,
			'email'  => '<p class="comment-form-email col6">' . '<input id="email" placeholder="Vaš email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' />'  .
				
		
			'</div>'
		)
	),
	'comment_field' => '<p class="comment-form-comment">' .
		
		'<textarea id="comment" name="comment" placeholder="Vaš komentar" cols="45" rows="8" aria-required="true"></textarea>' .
		'</p>',
    'comment_notes_after' => '',
    'comment_notes_before' => '',
    'title_reply' => '<div class="crunchify-text"> <h2 class="text-center">POŠALJITE VAŠ KOMENTAR</h2></div>',
    'label_submit' => __('POŠALJITE KOMENTAR'),
);
?>
<?php comment_form($args); ?>

</div>
