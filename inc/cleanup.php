<?php
/*
@package sparky theme
*/
// remove generator version number

function sparkyThemeRemoveWPVersionStrings($src){
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version){
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}

add_filter( 'script_loader_src', 'sparkyThemeRemoveWPVersionStrings');
add_filter( 'style_loader_src', 'sparkyThemeRemoveWPVersionStrings');

function sparkyThemeRemoveMetaVersion(){
    return '';
}

add_filter( 'the_generator', 'sparkyThemeRemoveMetaVersion' );