<?php 
/*
Libreria de funciones personalizadas para Wordpress
*/ 

//Esta función nos permite obtener el excerpt de un post, con un límite de caracteres definido por nosotros
function get_excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."...";
    echo $excerpt;
}


// Este filtro nos permiten agregar clases a los elementos de los menús de Wordpress
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;

}
// Este filtro nos permiten agregar clases a los anchor de los menús de Wordpress
add_filter('wp_nav_menu','add_menuclass');
function add_menuclass($ulclass) {
	return preg_replace('/<a /', '<a class="nav-link text-white"', $ulclass);
}
// Este filtro nos permite agregar la clase "active" al elemento del menú que esté activo
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){

    $classes[] = 'active ';

  }
  return $classes;
}