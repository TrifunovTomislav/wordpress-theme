<h1>Sparky Theme Support</h1>
<?php  settings_errors(); ?>
<?php
  //  $picture = esc_attr(get_option('profile_picture')) ;
?>

<form method="post" action="options.php" class="sparky_theme_general_form">
    <?php settings_fields( 'sparky_theme_support' ); ?>
    <?php do_settings_sections( 'sparky_theme_options' ) ?>
    <?php submit_button(); ?>
</form>
