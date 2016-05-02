<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Footer 1','id' => 'footer-1', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div></div></div>','before_title' => '<h3>','after_title' => '</h3><div class="outer"><div class="inner">'));
    register_sidebar(array('name' => 'Footer 2','id' => 'footer-2', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div></div></div>','before_title' => '<h3>','after_title' => '</h3><div class="outer"><div class="inner">'));
    register_sidebar(array('name' => 'Footer 3','id' => 'footer-3', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div></div></div>','before_title' => '<h3>','after_title' => '</h3><div class="outer"><div class="inner">'));
}

add_action( 'init', 'the_widgets_init' );


    
?>