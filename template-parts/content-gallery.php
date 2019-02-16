<?php
// $detect = new Mobile_Detect;
global $detect;
/*
@package sparky theme
-- gallery post format
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sparky-format-gallery'); ?>>
    
	<header class="entry-header text-center">
    <?php if( sparkyGetAttachment() && !$detect->isMobile() && !$detect->isTablet() ):  ?>
        <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide sparky-carousel-thumb" data-ride="carousel">
			<div class="carousel-inner" role="listbox">   
				<?php 
					$attachments = sparkyGetBSSlides( sparkyGetAttachment(5) );
					foreach( $attachments as $attachment ):
				?>

				<div class="carousel-item item<?php echo $attachment['class']; ?>">
					<img class="d-block w-100 standard-featured" src="<?php echo $attachment['url']; ?>" >
					<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
					<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
					<div class="entry-excerpt image-caption">
						<p><?php echo $attachment['caption']; ?></p>
					</div><!-- entry-excerpt -->
				</div>
					
					<?php  endforeach; ?>
                </div><!-- .carousel-inner -->
				<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="">
						<div class="">
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="sparky-icon sparky-cheveron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</div><!-- preview-container -->
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
				<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="sparky-icon sparky-cheveron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</div><!-- preview-container -->
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
        </div><!-- carousel -->
        <?php endif; ?>
        <?php the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h1>'); ?>
		
		<div class="entry-meta">
			<?php echo sparkyPostedMeta(); ?>
		</div>
		
	</header>
	
	<div class="entry-content">
	<?php if(sparkyGetAttachment() && ($detect->isMobile() || $detect->isTablet())):?>
            <a class="standard-featured-link" href="<?php the_permalink(); ?>">
            <div class="standard-featured background-image" 
                style="background-image: url(<?php echo sparkyGetAttachment(); ?>);">
            </div></a><!-- standard-featured -->
        <?php endif; ?>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="button-container text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-sunset"><?php _e( 'Read More' ); ?></a>
		</div>
		
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php echo sparkyPostedFooter(); ?>
	</footer>


</article>