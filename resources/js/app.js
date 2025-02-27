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
        minDate: "2025-02-01",
        maxDate: "today"
    });
});
