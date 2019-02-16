<?php
/*
@package sparky theme
-- audio post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-audio'); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title"><a href="'. esc_url(get_permalink()) .'" rel="bookmark" >', '</a></h1>' ); ?>
        <div class="entry-meta">
            <?php echo sparkyPostedMeta(); ?>
        </div><!-- entry-meta -->
    </header>
    <div class="entry-content">
        <?php echo getEmbeddedMedia(array('audio','iframe')); ?>
    </div><!-- entry-content -->
    <footer class="entry-footer">
        <?php echo sparkyPostedFooter(); ?>
    </footer>
</article>