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