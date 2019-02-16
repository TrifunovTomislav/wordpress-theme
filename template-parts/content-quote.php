<?php
/*
@package sparky theme
-- quote post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-quote'); ?>>
    <header class="entry-header text-center">
        <div class="row">
            <div class="col-sm-10 col-md-8 offset-sm-1 offset-md-2">
            <h1 class="quote-content">
                <a href="<?php the_permalink(); ?>"rel="bookmark">
                <?php echo get_the_content(); ?></a>
            </h1>
            <?php the_title( '<h2 class="quote-author">- ', ' -</h2>' ); ?>
        </div><!-- col-md-8 -->
        </div><!-- row -->
    </header>

    <footer class="entry-footer">
        <?php echo sparkyPostedFooter(); ?>
    </footer>
</article>