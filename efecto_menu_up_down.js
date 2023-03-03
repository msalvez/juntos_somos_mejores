// Menú efecto scroll down/up
// En esta variable guardo la ubicacion inicial del scroll
let ubicacionInicial = window.pageYOffset;
// Cuando el usuario haga scroll ejecuto la funcion
window.onscroll = function () {
    // Creo una nueva variable en donde guardo la ubicacion actual del scroll
    let valorActual = window.pageYOffset;
    // Si la ubicacion actual es menor o igual a la ubicacion inicial
    if (ubicacionInicial <= valorActual) {
        // al header le agrego un estilo para que tenga una opacidad de 0 con una transicion de 0.5s
        document.getElementsByTagName("header")[0].style.opacity = "0";
        document.getElementsByTagName("header")[0].style.transition = "0.5s";
    } else {
        // al header le agrego un estilo para que tenga una opacidad de 1 con una transicion de 0.5s
        document.getElementsByTagName("header")[0].style.opacity = "1";
        document.getElementsByTagName("header")[0].style.transition = "0.5s";
    }
    // La variable ubicacion inicial toma el valor de la ubicacion actual
    ubicacionInicial = valorActual;
}
