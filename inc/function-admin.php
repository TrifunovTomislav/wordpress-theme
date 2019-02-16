<?php

/*
=============
ADMIN PAGE
============
*/

function sparkyAddAdminPage(){

    // generate sparky admin page
    add_menu_page('Sparky Theme Options',
                  'Sparky :)', 
                  'manage_options', 
                  'sparky_theme', 
                  'sparkyThemeCreatePage', 
                  get_template_directory_uri() . '/img/logo.png', 
                  110 );

    // generate sparky admin subpages
    add_submenu_page( 'sparky_theme', 
                      'Sparky Sidebar Options', 
                      'Sidebar', 
                      'manage_options', 
                      'sparky_theme', 
                      'sparkyThemeCreatePage' );

    add_submenu_page( 'sparky_theme', 
                      'Sparky Theme Options', 
                      'Theme Options', 
                      'manage_options', 
                      'sparky_theme_options', 
                      'sparkyThemeSupportPage' );
   
    add_submenu_page( 'sparky_theme', 
                      'Sparky Theme Options', 
                      'Theme Contact Form', 
                      'manage_options', 
                      'sparky_theme_contact', 
                      'sparkyThemeContactPage' );

    add_submenu_page( 'sparky_theme', 
                      'Sparky Theme CSS', 
                      'Custom CSS', 
                      'manage_options', 
                      'sparky_theme_css', 
                      'sparkyThemeCssSettingsPage' );
   
    // activate custom settings
    add_action('admin_init', 'sparkyCustomSettings');
}

add_action( 'admin_menu', 'sparkyAddAdminPage');

function sparkyCustomSettings(){
    // sidebar options
    register_setting( 'sparky_theme-settings-group', 'profile_picture' );
    register_setting( 'sparky_theme-settings-group', 'first_name' );
    register_setting( 'sparky_theme-settings-group', 'last_name');
    register_setting( 'sparky_theme-settings-group', 'user_description');
    register_setting( 'sparky_theme-settings-group', 'twitter_handler', 'sparkyThemeSanitizeTwitterHandler'  );
    register_setting( 'sparky_theme-settings-group', 'facebook_handler' );
    register_setting( 'sparky_theme-settings-group', 'gplus_handler' );

    add_settings_section( 'sparky_theme-sidebar-options', 
                          'Sidebar Options', 
                          'sparkySidebarOptions', 
                          'sparky_theme' );

    add_settings_field(   'sidebar-profile_picture', 
                          'Profile Picture', 
                          'sparkySidebarProfilePicture', 
                          'sparky_theme', 
                          'sparky_theme-sidebar-options' );
    add_settings_field( 'sidebar-name', 
                        'Full Name', 
                        'sparkySidebarName', 
                        'sparky_theme', 
                        'sparky_theme-sidebar-options' );
    add_settings_field( 'sidebar-description', 
                        'Description', 
                        'sparkySidebarDescription', 
                        'sparky_theme', 
                        'sparky_theme-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 
                        'Twitter handler', 
                        'sparkySidebarTwitter', 
                        'sparky_theme', 
                        'sparky_theme-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 
                        'Facebook handler', 
                        'sparkySidebarFacebook', 
                        'sparky_theme', 
                        'sparky_theme-sidebar-options' );
    add_settings_field( 'sidebar-gplus', 
                        'Gplus handler', 
                        'sparkySidebarGplus', 
                        'sparky_theme', 
                        'sparky_theme-sidebar-options' );

    // theme support otions
    register_setting( 'sparky_theme_support', 'post_formats' );
    register_setting( 'sparky_theme_support', 'custom_header' );
    register_setting( 'sparky_theme_support', 'custom_background' );
    
    add_settings_section( 'sparky_theme_support_options', 
                          'Theme Options', 
                          'sparkyThemeOptions', 
                          'sparky_theme_options' );

    add_settings_field( 'post-formats', 
                        'Post formats', 
                        'sparkyThemePostFormats', 
                        'sparky_theme_options', 
                        'sparky_theme_support_options' );
    add_settings_field( 'custom-header', 
                        'Custom Header', 
                        'sparkyThemeCustomHeader', 
                        'sparky_theme_options', 
                        'sparky_theme_support_options' );
    add_settings_field( 'custom-background', 
                        'Custom Background', 
                        'sparkyThemeCustomBackground', 
                        'sparky_theme_options', 
                        'sparky_theme_support_options' );

    // contact form options
    register_setting('sparky_theme_contact_options', 'activate_form');

    add_settings_section('sparky_theme_contact_section',
                          'Contact Form',
                          'sparkyThemeContactSection',
                          'sparky_theme_contact' );

    add_settings_field('activate-form',
                        'Activate Contact Form',
                        'sparkyThemeActivateContact',
                        'sparky_theme_contact',
                        'sparky_theme_contact_section');

    // custom css options
    register_setting( 'sparky_theme_custom_css', 'sparky_css', 'sparkyThemeSanitizeCustomCSS');
    add_settings_section( 'sparky_theme_custom_css_section', 
                            'Custom CSS', 
                            'sparkyThemeCustomCSSSection', 
                            'sparky_theme_css' );
    add_settings_field('custom-css', 
                        'Insert Your CSS',
                        'sparkyThemeCustomCSSField',
                        'sparky_theme_css',
                        'sparky_theme_custom_css_section');
}
// custom css functions
function sparkyThemeCustomCSSSection(){
    echo 'Customize you theme with your own CSS';
}

function sparkyThemeCustomCSSField(){
    $css = get_option('sparky_css');
    $css = empty($css) ? '/* Sparky Theme Custom CSS */': $css;
    echo '<div id="customCss">'. $css .'</div>
            <textarea id="sparky_css" 
                        name="sparky_css" 
                        style="display:none; visibility:hidden;">'. $css .'</textarea>';
}

// contact functions
function sparkyThemeContactSection(){
    echo 'Activate and Deactivate the build in contact form';
}

function sparkyThemeActivateContact(){
    $options = get_option('activate_form');
    $checked = (@$options == 1) ? 'checked' : '';
    echo '<label><input type="checkbox" 
                            id="activate_form" 
                            name="activate_form" 
                            value = "1" '. $checked .' /></label>';
}

// options functions
function sparkyThemeOptions(){
    echo 'Activate and Deactivate specific Theme Support Options';
}

function sparkyThemePostFormats(){
    $options = get_option('post_formats');
    $formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
    $output = '';
    foreach ($formats as $format) {
        $checked = (isset($options[$format]) == 1) ? 'checked' : '';
        $output .= '<label><input type="checkbox" 
                                  id="' . $format . '" 
                                  name="post_formats[' . $format . ']" 
                                  value = "1" '. $checked .' />' . $format . '</label><br/>';
    }
    echo $output;
}

function sparkyThemeCustomHeader(){
    $options = get_option('custom_header');
    $checked = (@$options == 1) ? 'checked' : '';
    echo '<label><input type="checkbox" 
                            id="custom_header" 
                            name="custom_header" 
                            value = "1" '. $checked .' />Activate Custom Header</label>';
}

function sparkyThemeCustomBackground(){
    $options = get_option('custom_background');
    $checked = (@$options == 1) ? 'checked' : '';
    echo '<label><input type="checkbox" 
                            id="custom_background" 
                            name="custom_background" 
                            value = "1" '. $checked .' />Activate Custom Background</label>';
}

// sidebar functions
function sparkySidebarProfilePicture(){
    $picture = esc_attr(get_option('profile_picture')) ;
    if(empty($picture   )){
        echo '<input type="button" 
                    value="upload profile picture" 
                    class="button button-secondary"
                    id="upload_button" />
            <input type="hidden" 
                    name="profile_picture" 
                    id="profile_picture"
                    value="' . $picture . '" />'; 
    }else{
        echo '<input type="button" 
                    value="replace profile picture" 
                    class="button button-secondary"
                    id="upload_button" />
            <input type="hidden" 
                            name="profile_picture" 
                            id="profile_picture"
                            value="' . $picture . '" />
            <input type="button" 
                    value="remove profile picture" 
                    class="button button-secondary"
                    id="remove_picture" />';
    }
    
}

function sparkySidebarDescription(){
    $description = esc_attr(get_option('user_description')) ;
    echo '<input type="text" 
                 name="user_description" 
                 value="' . $description . '" 
                 placeholder="Description" />
                 <p class="description">Write something smart</p>';
}

function sparkySidebarGplus(){
    $gplus = esc_attr(get_option('gplus_handler')) ;
    echo '<input type="text" 
                 name="gplus_handler" 
                 value="' . $gplus . '" 
                 placeholder="Gplus handler" />';
}

function sparkySidebarFacebook(){
    $facebook = esc_attr(get_option('facebook_handler')) ;
    echo '<input type="text" 
                 name="facebook_handler" 
                 value="' . $facebook . '" 
                 placeholder="Facebook handler" />';
}

function sparkySidebarTwitter(){
    $twitter = esc_attr(get_option('twitter_handler')) ;
    echo '<input type="text" 
                 name="twitter_handler" 
                 value="' . $twitter . '" 
                 placeholder="Twitter handler" />
                 <p class="description">Input your twitter username without the @ character.</p>';
}

function sparkySidebarName(){
    $first_name = esc_attr(get_option('first_name')) ;
    $last_name = esc_attr(get_option('last_name')) ;
    echo '<input type="text" 
                 name="first_name" 
                 value="' . $first_name . '" 
                 placeholder="First Name" />
          <input type="text" 
                 name="last_name" 
                 value="' . $last_name . '" 
                 placeholder="Last Name" />' ;
}

// sanitization settings
function sparkyThemeSanitizeTwitterHandler($input){
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}

function sparkyThemeSanitizeCustomCSS($input){
    $output = esc_textarea($input);
    return $output;
}

function sparkySidebarOptions(){
    echo 'Customize your Sidebar Information';
}

// template submenu functions
function sparkyThemeCreatePage(){
    // generation of admin sidebar page
    require_once(get_template_directory() . '/inc/templates/sparky-admin.php');
}

function sparkyThemeSupportPage(){
    // generation of admin support page
    require_once(get_template_directory() . '/inc/templates/sparky-theme-support.php');
}

function sparkyThemeContactPage(){
    // generation of contact page settings subpage
    require_once(get_template_directory() . '/inc/templates/sparky-contact-form.php');
}

function sparkyThemeCssSettingsPage(){
    require_once(get_template_directory() . '/inc/templates/sparky-custom-css.php');
}