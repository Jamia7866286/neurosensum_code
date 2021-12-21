<?php
    function add_scripts() {
      wp_enqueue_style('plugins', get_stylesheet_directory_uri() . '/assets/css/plugins.min.css',false,null,'all');
      //wp_enqueue_style('layout', get_stylesheet_directory_uri() . '/assets/css/layout.css',false,null,'all');
      wp_enqueue_style('survey', get_stylesheet_directory_uri() . '/style.css',false,null,'all');
      wp_enqueue_style('survey-responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css',false,null,'all');
      wp_enqueue_script('plugins',get_stylesheet_directory_uri() . '/assets/js/plugins.min.js', array ( 'jquery' ), null, true);
	  wp_enqueue_script('match-height',get_stylesheet_directory_uri() . '/assets/js/jquery-match-height.js', array ( 'jquery' ), null, true);
      //wp_enqueue_script('floatit',get_stylesheet_directory_uri() . '/assets/js/jquery.floatit.js', array ( 'jquery' ), null, true);
      wp_enqueue_script('survey',get_stylesheet_directory_uri() . '/assets/js/main.js', array ( 'jquery' ), null, true);
      }