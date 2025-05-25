'use strict';
import 'bootstrap/js/dist/tab';

document.addEventListener('DOMContentLoaded', () => {
    const startDate = document.getElementById('start-month');
    const endDate = document.getElementById('end-month');

    if (startDate && endDate) {
        startDate && startDate.addEventListener('change', () => {
            if (startDate.value) {
                endDate.disabled = false;
            } else {
                endDate.disabled = true;
                endDate.value = '';
            }
        });
    }
});
