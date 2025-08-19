const nav = document.querySelector('#nav-list');
const abrir = document.querySelector('#hamburger-abrir');
const cerrar = document.querySelector('#hamburger-cerrar');


abrir.addEventListener('click', () => {
    nav.classList.add('visible');
})
cerrar.addEventListener('click', () => {
    nav.classList.remove('visible');
})

document.addEventListener("DOMContentLoaded", function () {
        const Tema = document.getElementById("tema1");
        const Boton = document.getElementById("documento-boton");
        const Documento = document.getElementById("documento1");

        document.addEventListener("click", function (event) {
            if (Documento.style.display == "block") {
                Documento.style.display = "none";
            } else {
                Documento.style.display = "block";
            }
        });

    });