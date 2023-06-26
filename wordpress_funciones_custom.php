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



/*========================================================================================================= */
// Función de exclusión: solo mostrar los posts en resultados de búsqueda.
/*========================================================================================================= */
add_action('pre_get_posts','exclude_all_pages_search');
function exclude_all_pages_search($query) {
    $query->set( 'post_type', 'post' );
}


/*========================================================================================================= 
// Función para deshabilitar los feeds de Wordpress
========================================================================================================= */
function muu_disable_feed() {
 wp_die( __( 'No hay feeds disponibles, Volver al inicio <a href="'. esc_url( home_url( '/' ) ) .'">Inicio</a>!' ) );
}

add_action('do_feed', 'muu_disable_feed', 1);
add_action('do_feed_rdf', 'muu_disable_feed', 1);
add_action('do_feed_rss', 'muu_disable_feed', 1);
add_action('do_feed_rss2', 'muu_disable_feed', 1);
add_action('do_feed_atom', 'muu_disable_feed', 1);
add_action('do_feed_rss2_comments', 'muu_disable_feed', 1);
add_action('do_feed_atom_comments', 'muu_disable_feed', 1);

// Remuevo los elementos del cabezal
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/*=========================================================================================================
// Función para quitar los estilos de los bloque de Woocommerce
=========================================================================================================*/
function muustack_quitar_estilos_bloques_woo() {
wp_deregister_style( 'wc-blocks-style' );
wp_dequeue_style( 'wc-blocks-style' );
}
add_action( 'enqueue_block_assets', 'muustack_quitar_estilos_bloques_woo' );


/*=========================================================================================================
// Función para quitar los estilos adicionales del header
=========================================================================================================*/
function remove_wp_head_styles() {
    // Desactivar estilos generados por WordPress en el <head>
    wp_dequeue_style('wp-block-library'); // Estilos de los bloques de Gutenberg
    wp_dequeue_style('wp-block-library-theme'); // Estilos del tema para los bloques de Gutenberg
    wp_dequeue_style('wp-embed'); // Estilos para la incrustación de contenido

    // Si hay más estilos generados por WordPress que deseas desactivar, puedes agregarlos aquí
}
add_action('wp_enqueue_scripts', 'remove_wp_head_styles', 100);

/*=========================================================================================================
// Función para quitar los estilos Emojis
=========================================================================================================*/
function disable_emojis() {
    // Desactivar emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Desactivar Embeds (incrustaciones)
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'disable_emojis');

/*=========================================================================================================
// Función para quitar el feed
=========================================================================================================*/
function muu_disable_feed() {
 wp_die( __( 'No hay feeds disponibles, Volver al inicio <a href="'. esc_url( home_url( '/' ) ) .'">Inicio</a>!' ) );
}

add_action('do_feed', 'muu_disable_feed', 1);
add_action('do_feed_rdf', 'muu_disable_feed', 1);
add_action('do_feed_rss', 'muu_disable_feed', 1);
add_action('do_feed_rss2', 'muu_disable_feed', 1);
add_action('do_feed_atom', 'muu_disable_feed', 1);
add_action('do_feed_rss2_comments', 'muu_disable_feed', 1);
add_action('do_feed_atom_comments', 'muu_disable_feed', 1);

// Remuevo los elementos del cabezal
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
