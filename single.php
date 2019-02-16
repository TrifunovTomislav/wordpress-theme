<?php
/*
@package sparky theme
*/
?>
<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container">
            <div class="row">
            <div class="col-xs-12 col-md-10 col-lg-8 offset-lg-2 offset-md-1">
                <?php 
                    if(have_posts()): 
                        while(have_posts()): the_post();
                        
                            get_template_part('template-parts/single', get_post_format());
                            echo sparkyPostNavigation();
                            if(comments_open()):
                                comments_template();
                            endif;                        
                        endwhile;
                    endif;
                ?>
                </div> <!-- col-lg-8 -->
            </div><!-- row -->
        </div><!-- container -->
    </main>
</div><!-- primary -->

<?php get_footer(); ?>
