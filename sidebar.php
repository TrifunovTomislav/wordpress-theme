<?php
/*
@package sparky theme
*/
if(!is_active_sidebar('sparky-sidebar')){
    return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">
    
    <div class="d-block d-sm-none">
    <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'nav navbar-nav navbar-collapse',
        'walker' => new Sparky_Walker_Nav_Primary()
      ) );  
    ?>
    
  </div>
  <?php dynamic_sidebar('sparky-sidebar'); ?>
</aside>