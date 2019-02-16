<h1>Sparky Sidebar Options</h1>
<?php  settings_errors(); ?>
<?php
    $first_name = esc_attr(get_option('first_name')) ;
    $last_name = esc_attr(get_option('last_name')) ;
    $full_name = $first_name . ' ' . $last_name;
    $description = esc_attr(get_option('user_description'));
    $picture = esc_attr(get_option('profile_picture')) ;

    $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
	$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
	$gplus_icon = esc_attr( get_option( 'gplus_handler' ) );
?>
<div class="sparky_theme_preview">
    <div class="sparky_sidebar">
        <div class="image_container">
            <div class="profile_picture" 
                 style="background-image: url(<?php print $picture ?>)" 
                 id="profile_picture_preview"></div>
        </div>
        <h1 class="sparky_theme_username"><?php print $full_name ?></h1>
        <h2 class="sparky_theme_description"><?php print $description ?></h2>
        <div class="icons_wrapper">

        <?php if( !empty( $twitter_icon ) ): ?>
				<span class="sparky-icon-sidebar dashicons-before dashicons-twitter"></span>
			<?php endif; 
			if( !empty( $gplus_icon ) ): ?>
				<span class="sparky-icon-sidebar sparky-icon-sidebar--gplus dashicons-before dashicons-googleplus"></span>
			<?php endif; 
			if( !empty( $facebook_icon ) ): ?>
				<span class="sparky-icon-sidebar dashicons-before dashicons-facebook-alt"></span>
			<?php endif; ?>

        </div>
    </div>
</div>
<form method="post" action="options.php" class="sparky_theme_general_form">
    <?php settings_fields( 'sparky_theme-settings-group' ); ?>
    <?php do_settings_sections( 'sparky_theme' ) ?>
    <?php submit_button('Save Changes', 'primary','btnSubmit'); ?>
</form>
