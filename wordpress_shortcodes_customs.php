<?php 
/*
Libreria de Shortcodes personalizados para Wordpress
*/

/*==================================================================================
//Esta función nos permite crear un Shortcode que toma el año corriente.
//Ejemplo de implementación: [year] o do_shortcode('[year]');
==================================================================================*/
function year_shortcode(){

	$year = date_i18n ('Y');

	return $year;

}
add_shortcode ('year', 'year_shortcode');


/*==================================================================================
// Cuenta a los usuarios
// Ejemplo de implementación: [cant_usuarios] o do_shortcode('[cant_usuarios]');
==================================================================================*/
function muustack_count_users() {
    return count_users()['total_users']; 
} 
// Crea un shortcode para mostrar el numero de usuarios
add_shortcode('cant_usuarios', 'muustack_count_users');