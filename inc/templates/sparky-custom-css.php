<h1>Sparky Custom CSS</h1>
<?php  settings_errors(); ?>

<form id="custom_css_form" method="post" action="options.php" class="sparky_theme_general_form">
    <?php settings_fields( 'sparky_theme_custom_css' ); ?>
    <?php do_settings_sections( 'sparky_theme_css' ) ?>
    <?php submit_button(); ?>
</form>