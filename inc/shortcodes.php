<?php

/*
=====================
AJAX FUNCTIONSshortcode options
=====================
*/

function sparkyTooltip($atts, $content = null){
    //get the attributes
    $atts = shortcode_atts(
        array(
            'placement' => 'top',
            'title' => ''
        ),
        $atts,
        'tooltip'
    );
    $title = ($atts['title'] == '' ? $content : $atts['title']);
    //return HTML
    return '<span class="sparky-tooltip" 
                    data-toggle="tooltip" 
                    data-placement="'. $atts['placement'] .'" 
                    title="'. $title .'">
                '. $content .'
            </span>';
}

add_shortcode( 'tooltip', 'sparkyTooltip' );

function sparkyPopover($atts, $content = null){
    //get the attributes
    $atts = shortcode_atts(
        array(
            'placement' => 'top',
            'title' => '',
            'trigger' => 'click',
            'content' => ''
        ),
        $atts,
        'popover'
    );
    
    //return HTML
    return '<span  class="sparky-popover" 
                    data-toggle="popover" 
                    data-content="'. $atts['content'] .'"
                    trigger="'. $atts['trigger'] .'" 
                    data-placement="'. $atts['placement'] .'" 
                    title="'. $atts['title'] .'">
                '. $content .'
            </span>';
}

add_shortcode( 'popover', 'sparkyPopover' );

//sparky contact form
function sparkyContactForm($atts, $content = null){
    //[contact_form]
    //get the attributes
    $atts = shortcode_atts(
        array(),
        $atts,
        'contact_form'
    );

    //return HTML
    ob_start();
    include 'templates/contact-form.php';
    return ob_get_clean();
}

add_shortcode( 'contact_form', 'sparkyContactForm' );