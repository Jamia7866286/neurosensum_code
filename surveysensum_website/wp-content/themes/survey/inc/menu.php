<?php
function register_my_menus() {
	register_nav_menus(
		array(
            'primary' => __('Primary Navigation', 'twentyten'),
            'Read-Menu' => __('Read Menu', 'twentyten'),
            'Products-Menu' => __('Products Menu', 'twentyten'),
            'Resources-Menu' => __('Resources Menu', 'twentyten'),
            'Footer-Menu' => __('Footer Menu', 'twentyten'),
            'Category-Menu' => __('Category Menu', 'twentyten'),
	)
	);
}


function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );