<?php
/*
@package sparky theme
*/
if(post_password_required()){
    return;
}
?>

<div id="comments" class="comments-area">

    <?php  
        if(have_comments()):
            //we have comments
    ?>

    <h2 class="comments-title">
        <?php 
            printf(
                esc_html(_nx('One comment on &ldquo;%2$s&rdquo;', 
                                '%1$s comments on &ldquo;%2$s&rdquo;', 
                                get_comments_number(), 
                                'comments title',
                                'sparky theme')),
                number_format_i18n( get_comments_number()),
                '<span>'. get_the_title() .'</span>'
            );
        ?>
    </h2>

    <?php sparkyGetPostNavigation(); ?>
    <ol class="comment-list">

        <?php
        $args = array(
            'walker'            => null,
            'max_depth'         => '',
            'style'             => 'ol',
            'callback'          => null,
            'end-callback'      => null,
            'type'              => 'all',
            'reply_text'        => 'Reply',
            'page'              => '',
            'per_page'          => '',
            'avatar_size'       => 64,
            'reverse_top_level' => true,
            'reverse_children'  => '',
            'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
            'short_ping'        => false,   // @since 3.6
            'echo'              => true     // boolean, default is true
        );
            wp_list_comments($args);
        ?>

    </ol>

    <?php sparkyGetPostNavigation(); ?>

    <?php
        if(!comments_open() && get_comments_number()):
    ?>

    <p class="no-comments"><?php esc_html_e('Comments are closed.', 'sparky theme'); ?></p>

    <?php
        endif;
    ?>

    <?php
        endif;
    ?>


    <?php 
 
    $fields = array(
        'author' =>
        '<div class="form-group"><label for="author">' . __( 'Name', 'domainreference' ) .
        '</label><span class="required">*</span>' .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" required/><div class="invalid-feedback">Please fill in this field</div></div>',

        'email' =>
        '<div class="form-group"><label for="email">' . __( 'Email', 'domainreference' ) .
        '</label><span class="required">*</span>' .
        '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" required/><div class="invalid-feedback">Please fill in this field</div></div>',

        'url' =>
        '<div class="form-group last-field"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
        '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" /></div>'
    );
    $args = array(
        'class_submit' => 'btn btn-primary btn-block',
        'class_form' =>'needs-validation',
        'label_submit' => __('Submit Comment'),
        'comment_field' =>  
        '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="4" required>' .
    '</textarea><div class="invalid-feedback">Please fill in this field</div></div>',
        'fields' => apply_filters( 'comment_form_default_fields', $fields )
    );
    comment_form($args);
    
    ?>
</div><!-- comments-area -->