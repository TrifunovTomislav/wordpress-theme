<?php
/*
@package sparky theme
-- standard post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title"><a href="'. esc_url(get_permalink()) .'" rel="bookmark" >', '</a></h1>' ); ?>
        <div class="entry-meta">
            <?php echo sparkyPostedMeta(); ?>
        </div><!-- entry-meta -->
    </header>
    <div class="entry-content">
        <?php if(sparkyGetAttachment()):?>
            <a class="standard-featured-link" href="<?php the_permalink(); ?>">
            <div class="standard-featured background-image" 
                style="background-image: url(<?php echo sparkyGetAttachment(); ?>);">
            </div></a><!-- standard-featured -->
        <?php endif; ?>
        <div class="entry-excerpt">
            <?php the_excerpt(  ); ?>
        </div><!-- entry-excerpt -->
        <div class="button-container text-center">
            <a href="<?php the_permalink() ?>" class="btn btn-sparky">
                <?php _e('Read More'); ?>
            </a>
        </div><!-- button-container -->
    </div><!-- entry-content -->
    <footer class="entry-footer">
        <?php echo sparkyPostedFooter(); ?>
    </footer>
</article>