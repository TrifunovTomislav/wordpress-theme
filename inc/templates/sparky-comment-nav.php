<nav class="comment-navigation" role="navigation">       
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="post-link-nav">
                <span class="sparky-icon sparky-cheveron-left" aria-hidden="true"></span>
                <?php previous_comments_link(esc_html__('Older comments', 'sparky theme')); ?>
            </div><!-- post-link-nav -->
        </div><!-- col-sm-6 -->
        
        <div class="col-xs-12 col-sm-6 text-right">
            <div class="post-link-nav">
                <?php next_comments_link(esc_html__('Newer comments', 'sparky theme')); ?>
                <span class="sparky-icon sparky-cheveron-right" aria-hidden="true"></span> 
                
            </div><!-- post-link-nav -->
        </div><!-- col-sm-6 text-right -->
    </div> <!-- row -->
</nav>