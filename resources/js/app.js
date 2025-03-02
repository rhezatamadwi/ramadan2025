import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';

window.Alpine = Alpine;
Alpine.plugin(flatpickr);

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    flatpickr('.datepicker', {
        dateFormat: "Y-m-d",
        minDate: "2025-02-28",
        maxDate: "today",
        defaultDate: "today"
    });

    const is_haid = document.querySelector('#is_haid');
    const container_form = document.querySelector('#container-laporan-form');
    const container_haid_form = document.querySelector('#container-laporan-haid-form');

    if(is_haid) {
        if(is_haid.value == 1) {
            container_form.style.display="none";
            container_haid_form.style.display="block";
        }
        else if(is_haid.value == 0 && is_haid.value != '') {
            container_form.style.display="block";
            container_haid_form.style.display="none";
        }
    }
});

// Get the element
const is_haid = document.querySelector('#is_haid');
const container_form = document.querySelector('#container-laporan-form');
const container_haid_form = document.querySelector('#container-laporan-haid-form');

if(is_haid) {
    is_haid.addEventListener('change', (e) => {
        // memilih sedang datang bulan
        if(e.target.value == 1) {
            container_form.style.display="none";
            container_haid_form.style.display="block";
        }
    
        // memilih tidak sedang datang bulan
        else {
            container_form.style.display="block";
            container_haid_form.style.display="none";
        }
    });
}