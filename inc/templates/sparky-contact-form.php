<h1>Sparky Contact Form</h1>
<?php  settings_errors(); ?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or a Post</p>
<p><code>[contact_form]</code></p>

<form method="post" action="options.php" class="sparky_theme_general_form">
    <?php settings_fields( 'sparky_theme_contact_options' ); ?>
    <?php do_settings_sections( 'sparky_theme_contact' ) ?>
    <?php submit_button(); ?>
</form>
