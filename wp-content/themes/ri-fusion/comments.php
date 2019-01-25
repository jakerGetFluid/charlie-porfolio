<?php

/* SETUP THE COMMENTS SECTION
================================================== */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
/* DISPLAY THE COMMENTS
================================================== */
?>

<div id="comments-list" class="comments">
	<h5 class="title-single-block"><?php comments_number(esc_html__('0 Comments', "ri-fusion"), esc_html(__('1 Comment', "ri-fusion")), esc_html(__('% Comments', "ri-fusion")) ); ?></h5>
	<?php if ( have_comments() ) :
		$ping_count = $comment_count = 0;
		foreach ( $comments as $comment )
			get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
		if ( ! empty($comments_by_type['comment']) ) : ?>
			<ol>
				<?php wp_list_comments('type=comment&callback=rit_fusion_custom_comments'); ?>
			</ol>
			<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
				<div id="comments-nav-below" class="comments-navigation">
					<div class="wrap-pagination clearfix"><?php paginate_comments_links(array('type'=>'list','prev_text'=> wp_kses(__('<i class="ss-navigateleft"></i> Previous', 'ri-fusion'), array('i'=>array('class'))),
								'next_text'    => wp_kses(__('Next <i class="ss-navigateright"></i>', 'ri-fusion'), array('i'=>array('class'))))); ?></div>
				</div><!-- #comments-nav-below -->
			<?php endif; ?>
		<?php endif; /* if ( $comment_count ) */ ?>
	<?php endif /* if ( $comments ) */ ?>
</div><!-- #comments-list .comments -->

<?php
/* COMMENT ENTRY FORM
================================================== */
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$ri_fusion_comment_args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>'<input id="author"  class="ipt text-field" placeholder="'.esc_attr__('Your name*','ri-fusion').'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
				'url'    => '<div class="row"><div class="col-sm-6 col-xs-12"> <input id="url"  class="ipt text-field" name="url" placeholder="'.esc_attr__('Url','ri-fusion').'" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '"/></div>',
				'email'  => '<div class="col-sm-6 col-xs-12"><input id="email"  class="ipt text-field" name="email" placeholder="'.esc_attr__('Email*','ri-fusion').'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div></div>'
				 ) ),
		'comment_field' =>'<textarea id="comment" class="textarea text-field" placeholder="'.esc_attr__('Messenger*','ri-fusion').'"  name="comment" cols="45" rows="8" aria-required="true"></textarea>',
		'class_submit'=>'btn btn-submit',
		'label_submit'      => esc_attr__( 'Post Comment','ri-fusion' ),

);
comment_form($ri_fusion_comment_args);
?>