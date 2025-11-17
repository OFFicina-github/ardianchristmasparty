document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('PartecipoModal');
    if (!modal) return;

    modal.addEventListener('shown.bs.modal', function () {
        const wrapper = modal.querySelector('.form-invitation');
        if (!wrapper) return;

        const inputs = wrapper.querySelectorAll('input[aria-required="true"]');
        const submitBtn = wrapper.querySelector('input[type="submit"]');
        if (!submitBtn) return;

        // disattiva inizialmente
        submitBtn.disabled = true;

        // Funzione per verificare se tutti i campi obbligatori sono compilati correttamente
        function checkFields() {
            let allValid = true;

            inputs.forEach(input => {
                // email valida o testo non vuoto
                if (input.type === 'email') {
                    const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
                    if (!emailValid) allValid = false;
                } else if (input.value.trim() === '') {
                    allValid = false;
                }
            });

            submitBtn.disabled = !allValid;
        }

        // Ascolta modifiche e digitazione
        inputs.forEach(input => {
            input.addEventListener('input', checkFields);
            input.addEventListener('change', checkFields);
        });

        // Reset del bottone quando il modale si chiude
        modal.addEventListener('hidden.bs.modal', () => {
            submitBtn.disabled = true;
            inputs.forEach(i => i.value = '');
        });

        // Nascondi la form-invitation al successo dell'invio CF7
        document.addEventListener('wpcf7mailsent', () => {
            wrapper.style.display = 'none';
        });

        // In caso di errore o invio, blocca di nuovo
        document.addEventListener('wpcf7invalid', () => {
            submitBtn.disabled = true;
        });
        document.addEventListener('wpcf7submit', () => {
            submitBtn.disabled = true;
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('nonPartecipoModal');
    if (!modal) return;

    modal.addEventListener('shown.bs.modal', function () {
        const wrapper = modal.querySelector('.form-invitation');
        if (!wrapper) return;

        const inputs = wrapper.querySelectorAll('input[aria-required="true"]');
        const submitBtn = wrapper.querySelector('input[type="submit"]');
        if (!submitBtn) return;

        // disattiva inizialmente
        submitBtn.disabled = true;

        // Funzione per verificare se tutti i campi obbligatori sono compilati correttamente
        function checkFields() {
            let allValid = true;

            inputs.forEach(input => {
                // email valida o testo non vuoto
                if (input.type === 'email') {
                    const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
                    if (!emailValid) allValid = false;
                } else if (input.value.trim() === '') {
                    allValid = false;
                }
            });

            submitBtn.disabled = !allValid;
        }

        // Ascolta modifiche e digitazione
        inputs.forEach(input => {
            input.addEventListener('input', checkFields);
            input.addEventListener('change', checkFields);
        });

        // Reset del bottone quando il modale si chiude
        modal.addEventListener('hidden.bs.modal', () => {
            submitBtn.disabled = true;
            inputs.forEach(i => i.value = '');
        });

        // Nascondi la form-invitation al successo dell'invio CF7
        document.addEventListener('wpcf7mailsent', () => {
            wrapper.style.display = 'none';
        });

        // In caso di errore o invio, blocca di nuovo
        document.addEventListener('wpcf7invalid', () => {
            submitBtn.disabled = true;
        });
        document.addEventListener('wpcf7submit', () => {
            submitBtn.disabled = true;
        });
    });
});

document.addEventListener('wpcf7mailsent', function (event) {
    const formId = event.detail.contactFormId;

    if (formId === 14 || formId === 711) {
        // document.querySelector('.save-date')?.style.setProperty('display', 'block');
        document.querySelector('.rsvp-header')?.style.setProperty('display', 'none');
        // document.querySelector('.form-invitation')?.style.setProperty('display', 'none');
        // document.getElementById('non-partecipo')?.style.setProperty('display', 'none');
        // document.querySelector('.partecipo-block')?.classList.add('invert-block');

        const wpcf7 = document.querySelector('.wpcf7');
        const saveDate = document.querySelector('.save-date');

        // Mostra wpcf7 per alcuni secondi
        setTimeout(() => {
            // Inizia fade-out
            wpcf7.classList.add('fade-out');

            // Dopo la durata della transizione (600ms), nascondi il blocco
            setTimeout(() => {
                wpcf7.classList.add('hidden');

                // Mostra save-date con effetto fade-in
                saveDate.classList.remove('hidden');
                requestAnimationFrame(() => {
                    // saveDate.classList.add('fade-out');
                    saveDate.classList.remove('fade-out');

                });
            }, 500); // deve corrispondere a transition: 0.6s

        }, 1400); // tempo di attesa prima del fade-out, in ms


    }

    else if (formId === 747) {
        document.querySelector('.hide-after')?.style.setProperty('display', 'none');
        // document.querySelector('.show-after')?.style.setProperty('display', 'block');
        document.querySelector('.non-partecipo-block')?.classList.add('invert-block');
        document.getElementById('partecipo')?.style.setProperty('display', 'none');


        const wpcf7 = document.querySelector('.non-partecipo-block .wpcf7');
        const showAfter = document.querySelector('.show-after');


        // Mostra wpcf7 per alcuni secondi
        setTimeout(() => {
            // Inizia fade-out
            wpcf7.classList.add('fade-out');

            // Dopo la durata della transizione (600ms), nascondi il blocco
            setTimeout(() => {
                wpcf7.classList.add('hidden');

                // Mostra save-date con effetto fade-in
                showAfter.classList.remove('hidden');
                requestAnimationFrame(() => {
                    // showAfter.classList.add('fade-out');
                    showAfter.classList.remove('fade-out');

                });
            }, 500); // deve corrispondere a transition: 0.6s

        }, 1400); // tempo di attesa prima del fade-out, in ms

    }
    document.querySelector('.button-container-box')?.classList.add('justify-content-center');
});

document.addEventListener('wpcf7invalid', function (event) {
    const invalid = event.detail.apiResponse.invalid_fields || [];
    const emailError = invalid.find(f => f.field === 'your-email' && f.message.includes('già registrata'));

    if (emailError) {
        // sostituisci il messaggio globale
        const responses = event.target.querySelectorAll('.wpcf7-response-output');
        responses.forEach(response => {
            response.textContent = 'Questa email risulta già registrata per l’evento.';
            response.classList.add('email-duplicate');
        });
    }
});