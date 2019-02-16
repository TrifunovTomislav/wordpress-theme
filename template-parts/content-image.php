<?php
/*
@package sparky theme
-- image post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-image'); ?>>  
    <header class="entry-header text-center background-image" style="background-image: url(<?php echo sparkyGetAttachment(); ?>);">
        <?php the_title( '<h1 class="entry-title"><a href="'. esc_url(get_permalink()) .'" rel="bookmark" >', '</a></h1>' ); ?>
        <div class="entry-meta">
            <?php echo sparkyPostedMeta(); ?>
        </div><!-- entry-meta -->
        <div class="entry-excerpt image-caption">
        <?php the_excerpt(  ); ?>
    </div><!-- entry-excerpt -->
    </header>
    <footer class="entry-footer">
        <?php echo sparkyPostedFooter(); ?>
    </footer>
</article>