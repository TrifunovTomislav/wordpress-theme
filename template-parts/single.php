<?php
/*
@package sparky theme
-- single post template
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="entry-meta">
            <?php echo sparkyPostedMeta(); ?>
        </div><!-- entry-meta -->
    </header>
    <div class="entry-content clearfix">
        <?php the_content(); ?>
    </div><!-- entry-content -->

    <footer class="entry-footer">
        <?php echo sparkyPostedFooter(); ?>
    </footer>
</article>