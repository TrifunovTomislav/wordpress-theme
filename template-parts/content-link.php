<?php
/*
@package sparky theme
-- link post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-link'); ?>>
    <header class="entry-header text-center">
        <?php 
        $link = sparkyGrabUrl();
        the_title( '<h1 class="entry-title"><a href="'. $link .'" target="blank">', '<div class="link-icon"><span class="sparky-icon sparky-link"></span></div></a></h1>' ); ?>
    </header>
</article>