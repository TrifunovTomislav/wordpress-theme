<?php
/*
@package sparky theme
-- aside post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-aside'); ?>>
<div class="aside-container">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-2 text-center">
            <?php if(sparkyGetAttachment()):?>
                <div class="aside-featured background-image" 
                    style="background-image: url(<?php echo sparkyGetAttachment(); ?>);">
                </div></a><!-- standard-featured -->
            <?php endif; ?>
        </div><!-- col-md-3 -->
        
        <div class="col-xs-12 col-sm-9 col-md-10">
            <header class="entry-header">
                <div class="entry-meta">
                    <?php echo sparkyPostedMeta(); ?>
                </div><!-- entry-meta -->
            </header>
            <div class="entry-content">
                <div class="entry-excerpt">
                    <?php the_content(  ); ?>
                </div><!-- entry-excerpt -->
            </div><!-- entry-content -->
        </div><!-- col-md-10 -->  
    </div><!-- row -->
    <footer class="entry-footer">
        <div class="row">
            <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
                <?php echo sparkyPostedFooter(); ?>
            </div><!-- offset-md-2 --> 
        </div><!-- row -->
    </footer>
</div><!-- aside-container -->
</article>