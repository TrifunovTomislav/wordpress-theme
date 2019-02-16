<?php

/*
=======================
THEME CUSTOM POST TYPES
=======================
*/

$contact = get_option( 'activate_form' );
if(@$contact == 1){
  add_action('init', 'sparkyThemeContactCPT');
  add_filter('manage_sparky-theme-contact_posts_columns', 'sparkyThemeSetContactColumns');
  add_action('manage_sparky-theme-contact_posts_custom_column', 'sparkyThemeCustomColumn', 10, 2);
  add_action('add_meta_boxes', 'sparkyThemeContactAddMetaBox');
  add_action('save_post', 'sparkyThemeContactSaveEmailData');
}

/* Contact CPT */

function sparkyThemeContactCPT(){
    $labels = [
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message'
    ];

    $args = [
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'show_in_rest'      => true,
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => ['title','editor','author']
    ];

    register_post_type('sparky-theme-contact', $args);
}

function sparkyThemeSetContactColumns($columns){    
    $newColumns = [];
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';
    return $newColumns;
}

function sparkyThemeCustomColumn($column, $post_id){
    switch ($column) {
        case 'message':
            echo get_the_excerpt();
            break;
        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:' . $email . '">'. $email .'</a>';
            break;        

    }
}

/* CONTACT META BOXES */

function sparkyThemeContactAddMetaBox(){
    add_meta_box( 'contact_email', 
                    'User Email', 
                    'sparkyThemeContactEmail', 
                    'sparky-theme-contact',
                    'side');
}

function sparkyThemeContactEmail($post){
    wp_nonce_field( 'sparkyThemeContactSaveEmailData', 'sparky_theme_contact_email_nonce');
    $value = get_post_meta($post->ID, '_contact_email_value_key', true);
    echo '<label for="sparky_theme_contact_email_field">User Email Address</label>';
    echo '<input type="email" 
                id="sparky_theme_contact_email_field" 
                name="sparky_theme_contact_email_field" 
                value="'. esc_attr($value) .'" 
                size="25" />';
}

function sparkyThemeContactSaveEmailData($post_id){
    if(!isset($_POST['sparky_theme_contact_email_nonce'])){
        return;
    }

    if(!wp_verify_nonce( $_POST['sparky_theme_contact_email_nonce'], 'sparkyThemeContactSaveEmailData' )){
        return;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }

    if(!current_user_can( 'edit_post', $post_id )){
        return;
    }

    if(!isset($_POST['sparky_theme_contact_email_field'])){
        return;
    }

    $my_data = sanitize_text_field($_POST['sparky_theme_contact_email_field']);
    update_post_meta($post_id, '_contact_email_value_key', $my_data);
}