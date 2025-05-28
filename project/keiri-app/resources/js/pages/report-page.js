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

    document.getElementById('update-preview-report')?.addEventListener('click', (e) => {
        e.preventDefault();
        const inpStartMonth = document.getElementById('start-month');
        const inpEndMonth = document.getElementById('end-month');
        const inpYear = document.getElementById('year');

        const startMonth = Number(inpStartMonth?.value);
        const endMonth = Number(inpEndMonth?.value);
        const year = Number(inpYear?.value);

        if (!startMonth || !year || isNaN(startMonth) || isNaN(year)) {
            return;
        }

        if (inpEndMonth?.value) {
            if (!endMonth || isNaN(endMonth)) {
                return;
            }

            if (endMonth < startMonth) {
                return;
            }
        }

        document.getElementById('term-form')?.submit();
    });
});
