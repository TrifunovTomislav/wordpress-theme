<?php

/*
============================
ADMIN ENQUEUE FUNCTIONS HERE
============================
*/

function sparkyThemeAdminScripts($hook){
    //echo $hook;
    if('toplevel_page_sparky_theme' == $hook){  
        wp_register_style( 'sparky_admin', 
                            get_template_directory_uri() . '/css/sparky.admin.css', 
                            array(), 
                            '1.0.0',
                            'all' );
        wp_enqueue_style('sparky_admin');

        wp_enqueue_media();

        wp_register_script('sparky_admin_script', 
                            get_template_directory_uri() . '/js/sparky.admin.js', 
                            array('jquery'),
                            '1.0.0' ,
                            true);
        wp_enqueue_script( 'sparky_admin_script');
    }else if('sparky_page_sparky_theme_css' == $hook){
        wp_enqueue_style('sparky_theme_ace_style', 
                            get_template_directory_uri() . '/css/sparky.ace.css', 
                            array(), 
                            '1.0.0', 
                            'all');
        wp_enqueue_script( 'sparky_theme_ace', 
                            get_template_directory_uri() . '/js/ace/ace.js', 
                            array('jquery'), 
                            '1.4.2', 
                            true );
        wp_enqueue_script('sparky_theme_custom_css_script',
                            get_template_directory_uri() . '/js/sparky.custom_css.js',
                            array('jquery'),
                            '1.0.0',
                            true);
    }else{
        return;
    }
}

add_action( 'admin_enqueue_scripts', 'sparkyThemeAdminScripts' );

/*
================================
FRONT END ENQUEUE FUNCTIONS HERE
================================
*/

function sparkyThemeFrontEndScripts(){
    wp_enqueue_style('bootstrap', 
                            get_template_directory_uri() . '/css/bootstrap.min.css', 
                            array(), 
                            '4.0.0', 
                            'all');
    wp_enqueue_style('sparky_theme_style', 
                            get_template_directory_uri() . '/css/sparkyTheme.css', 
                            array(), 
                            '1.0.0', 
                            'all');
    wp_enqueue_style('railway_font', 'https://fonts.googleapis.com/css?family=Raleway:300,400,500');
    wp_deregister_script( 'jquery' );
    wp_register_script('jquery', 
                            get_template_directory_uri() . '/js/jquery.min.js', 
                            false,
                            '3.3.1' ,
                            true);
    wp_enqueue_script('jquery');
    
    wp_enqueue_script('popper',
                            get_template_directory_uri() . '/js/popper.js',
                            array('jquery'),
                            '1.12.2',
                            true);

    wp_enqueue_script('bootstrap',
                            get_template_directory_uri() . '/js/bootstrap.min.js',
                            array('jquery'),
                            '4.0.0',
                            true);
    wp_enqueue_script('sparkyTheme',
                            get_template_directory_uri() . '/js/sparkyTheme.js',
                            array('jquery'),
                            '1.0.0',
                            true);

}

add_action('wp_enqueue_scripts', 'sparkyThemeFrontEndScripts');