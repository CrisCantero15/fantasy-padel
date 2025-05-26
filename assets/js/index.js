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