// Acordeón

const startAcordeon = () => {

    const headersAcordeon = document.querySelectorAll('.headAcordeon');

    for (let i = 0; i < headersAcordeon.length; i++) {
        
        headersAcordeon[i].addEventListener('click', () => {
            
            const pestanaAcordeon = headersAcordeon[i].parentNode; // Obtengo al elemento padre
            const contentAcordeon = headersAcordeon[i].nextElementSibling; // Obtengo el elemento hermano (content)

            pestanaAcordeon.classList.toggle('activePestana');

            if (pestanaAcordeon.classList.contains('activePestana')) {

                contentAcordeon.style.height = `${ contentAcordeon.scrollHeight + 20 }px`;
                
            } else {
                
                contentAcordeon.style.height = '0px';

            }

            const svgIcon = headersAcordeon[i].querySelector('svg');
            const isPlus = svgIcon.innerHTML.includes('M12 4V20')

            if (isPlus) {

                svgIcon.innerHTML = `<path d="M4 12H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>`;

            } else {

                svgIcon.innerHTML = `
                    <path d="M4 12H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                `;

            }

        });

    }
    
}

// Alerta de GET no autorizado

const iniciarAlertaGET = (mensaje) => {

    alert(`GET no autorizado: ${mensaje}`);

}

// Funcionalidad: Pestañas de contenido

const activarPestanas = () => {

    document.querySelectorAll('.tituloPestana').forEach(tab => {

        // Evento click en cada h3 que actúa como pestaña
        tab.addEventListener('click', () => {
            iniciarPestanas(tab.id, tab.dataset.contenido);
        });

    });

}

const iniciarPestanas = (pestanaActiva, contenidoActivo) => {

    // Se limpia el color de todas las pestañas
    const pestanas = Array.from(document.getElementsByClassName('tituloPestana'));
    pestanas.forEach(pestana => {
        pestana.style.color = '#F5F5DC'; // Color por defecto
    });

    // Se limpian todos los contenidos para que estén ocultos
    const contenidos = Array.from(document.getElementsByClassName('panelTexto'));
    contenidos.forEach(contenido => {
        contenido.style.display = 'none'; // Ocultar todos los contenidos
    });

    // Se activa la pestaña seleccionada
    const pestanaSeleccionada = document.getElementById(pestanaActiva);
    pestanaSeleccionada.style.color = '#1bc2a4'; // Color de la pestaña seleccionada

    // Se muestra el contenido correspondiente a la pestaña seleccionada
    const contenidoSeleccionado = document.getElementById(contenidoActivo);
    contenidoSeleccionado.style.display = 'block'; // Se muestra el contenido seleccionado

}

// Botón de editar (eliminar readonly)

const iniciarBotonEditar = () => {

    document.querySelectorAll('.btnEditar').forEach(btn => {
        
        btn.addEventListener('click', () => {
            
            const filaFormulario = btn.closest("tr");
            const inputsEquipo = filaFormulario.querySelectorAll('input');

            inputsEquipo.forEach(input => {
                input.dataset.original = input.value // Guarda el valor original del input en el atributo data-original
                input.removeAttribute('readonly'); // Elimina el atributo readonly de los inputs
            });

            filaFormulario.querySelector('.btnGuardar').style.display = 'inline-block'; // Muestra el botón de guardar
            filaFormulario.querySelector('.btnDeshacer').style.display = 'inline-block'; // Muestra el botón de deshacer
            btn.style.display = 'none'; // Oculta el botón de editar

        });

    });

}

// Botón de deshacer (añadir readonly y eliminar el botón de guardar)

const iniciarBotonDeshacer = () => {

    document.querySelectorAll('.btnDeshacer').forEach(btn => {

        btn.addEventListener('click', () => {

            const filaFormulario = btn.closest('tr');
            const inputsEquipo = filaFormulario.querySelectorAll('input');

            inputsEquipo.forEach(input => {
                if (input.dataset.original !== undefined) {
                    input.value = input.dataset.original; // Restaura el valor original del input
                } else {
                    input.value = ''; // Restaura el valor vacío del input
                }
                input.setAttribute('readonly', ''); // Añade el atributo readonly a los inputs
            });

            filaFormulario.querySelector('.btnGuardar').style.display = 'none'; // Oculta el botón de guardar
            filaFormulario.querySelector('.btnEditar').style.display = 'inline-block'; // Muestra el botón de editar
            btn.style.display = 'none'; // Muestra el botón de deshacer

        });

    });

}