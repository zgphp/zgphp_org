<?php

function tk_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>


<!-- ONE COMMENT -->

<div <?php comment_class(); ?>>
                        <div class="comment-start-one left">
                        <div class="comment-start-title left">
                            <span><?php echo $comment->comment_author ?></span>
                            <p><?php echo $comment->comment_date ?> <?php if ($comment->comment_approved == '0') : ?><?php _e('- Your comment is awaiting moderation.', 'inkland') ?><?php endif; ?> <?php edit_comment_link(__(' - Edit - '),'  ','') ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                        </div><!--/comment-start-title-->
                        <div class="comment-images right">
                            <div class="mask-comment left"></div><!--/mask-comment-->
                            <?php echo get_avatar($comment,$size='50',$default='<path_to_url>' ); ?>
                        </div><!--/comment-images-->
                        <div class="comment-start-text left"><?php comment_text() ?></div><!--/comment-start-text-->
                    </div><!--/comment-start-one-->

</div><!--/comment-start-one-->


<?php } ?>

        <?php
        if (get_comments_number() == '0') {?>
            <h3><?php _e('No comments so far!', 'inkland');?></h3>
        <?php } else {?>
                <h3><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', 'inkland')?></h3>
        <?php }?>


<!-- COMMENTS LIST -->

        <?php wp_list_comments('type=comment&callback=tk_comments'); ?>


<?php if ( comments_open() ) : ?>


        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <div class="comment-title left"><?php _e('You must be', 'inkland')?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'inkland') ?></a> <?php _e('to post a comment.', 'inkland') ?></div>
                <?php else : ?>


<!-- FORM CHECKING -->


<script type="text/javascript">
function checkForm(){
    var errors = 0;

    if(jQuery('#comment').val() == ''){
        jQuery('#message').html('Please insert your message');
        errors++;jQuery('#comment').focus();
    }

    if(jQuery('#comment-email').val() == ''){
        jQuery('#message').html('Please insert your email');
        errors++;jQuery('#comment-email').focus();
    }

    if(jQuery('#author').val() == ''){
        jQuery('#message').html('Please insert your name');
        errors++;jQuery('#author').focus();
    }

    if(errors == 0){
        return true;
    }else{
        return false;
    }
}
</script>


<!-- COMMENT FORM -->

<div class="sign-up-home-content blog-single-user-content right">
    <div class="blog-categories left" style="margin: 4px 15px 0px 0;">
        <div class="bg-form-coment left"></div>
    </div>

        <h3><?php _e('Leave a Comment', 'inkland')?></h3>
        <div class="form-contact right">
            <a id="respond" name="respond"></a>
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform contact-form" onSubmit="return checkForm();">
                <?php if ( !$user_ID ){?>
                    <div class="bg-input left"><input class="contact_input_text" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="author" id="author" value=""/><span><?php if($req) echo _e('Name (required)', 'inkland'); ?></span></div>
                    <div class="bg-input left"><input class="contact_input_text" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="email" id="comment-email" value=""/><span><?php if($req) echo _e('E-mail (required)', 'inkland'); ?></span></div>
                <?php }?>
                    <div class="form-textarea"><textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="comment" id="comment" ></textarea></div><!--/form-textarea-->
                    <div id="message"></div>

                    <div class="white left">
                        <div class="white-left left"></div>
                        <input class="form-contact-submit-button"  type="submit" name="submit-comment" value="<?php _e('Send', 'inkland')?>" />
                        <div class="white-right left"></div>
                    </div>

                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
            </form>
</div>
</div>

        <?php endif; ?>

<?php else : ?>

<div class="comment-title left"><?php _e('Comments are closed', 'inkland')?></div>

<?php endif; ?>