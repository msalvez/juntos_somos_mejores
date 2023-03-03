<?php 
/*
Libreria de funciones personalizadas para Wordpress
*/ 


/*========================================================================================================= */
//Esta función nos permite obtener el excerpt de un post, con un límite de caracteres definido por nosotros
/*========================================================================================================= */
function get_excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."...";
    echo $excerpt;
}


/*========================================================================================================= */
// Este filtro nos permiten agregar clases a los elementos de los menús de Wordpress
/*========================================================================================================= */
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;

}


/*========================================================================================================= */
// Este filtro nos permiten agregar clases a los anchor de los menús de Wordpress
/*========================================================================================================= */
add_filter('wp_nav_menu','add_menuclass');
function add_menuclass($ulclass) {
	return preg_replace('/<a /', '<a class="nav-link text-white"', $ulclass);
}

/*========================================================================================================= */
// Este filtro nos permite agregar la clase "active" al elemento del menú que esté activo
/*========================================================================================================= */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){

    $classes[] = 'active ';

  }
  return $classes;
}

/*========================================================================================================= */
// Personalizando el login de Wordpress sin plugins!
/*========================================================================================================= */

//Cambiamos el logo del inicio
add_action( 'login_enqueue_scripts', 'muu_change_login_logo' );
function muu_change_login_logo() { ?> 
    <style type="text/css"> 
        #login h1 a {

            background-image: url('<?php echo get_template_directory_uri(); ?>/img/tu_logo_aqui.png'); /* Colocar url de la imagen */

            height: 80px;

            background-position: center;

            background-size: cover;

            width: 58px;

        } 					  
    </style>
<?php }



//Cambiamos la URL del logo			  
add_filter( 'login_headerurl', 'muu_login_logo_url' );
function muu_login_logo_url($url) {

    return home_url(); //Colocar url de retorno

}

//Revuevo el logo de wordpress del backend
function muu_admin_bar_remove() {

    global $wp_admin_bar;

    $wp_admin_bar->remove_menu( 'wp-logo' );

}
add_action( 'wp_before_admin_bar_render', 'muu_admin_bar_remove', 0 );

//Cambiar el pie de pagina del panel de Administración
function change_footer_admin() {
 $year = date('Y');
 echo '©'.$year.' Copyright · Desarrollado por <a href="https://muustack.com" target="_blank" style="color:black;"><b>MuuStack</b></a>';
}

add_filter('admin_footer_text', 'change_footer_admin');