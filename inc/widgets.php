<?php
/*
@package sparky theme
widget class
*/

class SparkyProfileWidget extends WP_Widget {
    // setup the widget name, description, etc...
    public function __construct(){
        $widget_ops = array(
            'classname' => 'sparky-profile-widget',
            'description' => 'Custom Sparky Profile Widget',
        );
        parent::__construct('sparky_profile', 'Sparky Profile', $widget_ops);
    }


    //back-end display of widget
    public function form($instance){
        echo '<p><strong>No options for this widget</strong></br>you can control the fields of this widget from <a href="http://localhost/new_wordpress/wp-admin/admin.php?page=sparky_theme">This Page</a></p>';
    }

    //fron-end display of widget
    public function widget($args, $instance){

        $first_name = esc_attr(get_option('first_name')) ;
        $last_name = esc_attr(get_option('last_name')) ;
        $full_name = $first_name . ' ' . $last_name;
        $description = esc_attr(get_option('user_description'));
        $picture = esc_attr(get_option('profile_picture')) ;

        $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
        $facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
        $gplus_icon = esc_attr( get_option( 'gplus_handler' ) );

        echo $args['before_widget'];
        ?>
        <div class="text-center">
            <div class="image_container">
                <div class="profile_picture" 
                    style="background-image: url(<?php print $picture ?>)" 
                    id="profile_picture_preview"></div>
            </div>
            <h1 class="sparky_theme_username"><?php print $full_name ?></h1>
            <h2 class="sparky_theme_description"><?php print $description ?></h2>
            <div class="icons_wrapper">

            <?php if( !empty( $twitter_icon ) ): ?>
                    <a href="https://twitter.com/<?php echo $twitter_icon; ?>" class="" target="_blank"><span class="sparky-icon-sidebar sparky-icon sparky-logo"></span></a>
                <?php endif; 
                if( !empty( $gplus_icon ) ): ?>
                    <a href="https://plus.google.com/u/0/<?php echo $gplus_icon; ?>" class=""  target="_blank"><span class="sparky-icon-sidebar sparky-icon-sidebar--gplus sparky-icon sparky-logo"></span></a>
                <?php endif; 
                if( !empty( $facebook_icon ) ): ?>
                    <a href="https://facebook.com/<?php echo $facebook_icon; ?>" class="" target="_blank"><span class="sparky-icon-sidebar sparky-icon sparky-logo"></span></a>
                <?php endif; ?>

            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

}

add_action( 'widgets_init', function(){
    register_widget('SparkyProfileWidget');
} );

/**edit default wordpress widget */

function sparkyTagCloudFontChange($args){
    $args['smallest'] = 8;
    $args['largest'] = 8;
    return $args;
}

add_filter('widget_tag_cloud_args', 'sparkyTagCloudFontChange');

/**save post views */

function sparkySavePostViews($postID){
    $metaKey = 'sparky_post_views';
    $views = get_post_meta( $postID, $metaKey, true );
    $count = (empty($views) ? 0 : $views);
    $count++;
    update_post_meta($postID, $metaKey, $count);
    echo $views;
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**popular post widget */
class SparkyPopularPostsWidget extends WP_Widget {
    public function __construct(){
        $widget_ops = array(
            'classname' => 'sparky-popular-posts-widget',
            'description' => 'Popular Posts Widget',
        );
        parent::__construct('sparky-popular-posts', 'Sparky Popular Posts', $widget_ops);
    }

     //back-end display of widget
     public function form($instance){
        $title = (!empty($instance['title']) ? $instance['title'] : 'Popular Posts');
        $tot = (!empty($instance['tot']) ? absint($instance['tot']) : 4);

        $output = '<p>';
        $output .= '<label for="'. esc_attr($this->get_field_id('title')) .'">Title:</label>';
        $output .= '<input type="text" class="widefat" id="'. esc_attr($this->get_field_id('title')) .'" name="'. esc_attr($this->get_field_name('title')) .'" value="'. esc_attr($title) .'">';           
        $output .= '</p>';

        $output .= '<p>';
        $output .= '<label for="'. esc_attr($this->get_field_id('tot')) .'" >Number of Posts:</label>';
        $output .= '<input type="number" class="widefat" id="'. esc_attr($this->get_field_id('tot')) .'" name="'. esc_attr($this->get_field_name('tot')) .'" value="'. esc_attr($tot) .'">';           
        $output .= '</p>';

        echo $output;
    }

    //update widget
    public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' ;
		$instance[ 'tot' ] =  !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 ;
		
		return $instance;
		
	}

    //front-end display of widget
    public function widget($args, $instance){
       
        $tot = absint($instance['tot']);
        $posts_args = array (
            'post_type' => 'post',
            'posts_per_page' => $tot,
            'meta_key' => 'sparky_post_views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        $posts_query = new WP_Query($posts_args);


        echo $args['before_widget'];

        if(!empty($instance['title'])):
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        endif;

        if($posts_query->have_posts()):
            //echo '<ul>';

            while ($posts_query->have_posts()): $posts_query->the_post();

                echo '<div class="media">';
                echo '<div class="media-left"><img class="media-object" src="'. get_template_directory_uri() .'/img/post-'. (get_post_format() ? get_post_format() : 'standard') .'.png" alt="'. get_the_title() .'"/></div>';
                echo '<div class="media-body">';
                echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
				echo '<div class="row"><div class="col-xs-12">'. sparkyPostedFooter(true) .'</div></div>';
                echo '</div>';
                echo '</div>';

            endwhile;
                        
            //echo '</ul>';
        endif;

        echo $args['after_widget'];
    }

}
add_action('widgets_init', function(){
    register_widget( 'SparkyPopularPostsWidget' );
});