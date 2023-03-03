<?php 
/*
Libreria de Shortcodes personalizados para Wordpress
*/

//Esta función nos permite crear un Shortcode que toma el año corriente.
//Ejemplo de implementación: [year] o do_shortcode('[year]');
function year_shortcode(){

	$year = date_i18n ('Y');

	return $year;

}
add_shortcode ('year', 'year_shortcode');
