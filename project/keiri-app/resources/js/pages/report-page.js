'use strict';
import 'bootstrap/js/dist/tab';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-rowgroup-bs5';

document.addEventListener('DOMContentLoaded', () => {
    const tblReportMonthlyPaymentRequest = document.querySelectorAll('.report-monthly_payment_request');
    tblReportMonthlyPaymentRequest.forEach((tbl) => {
        new DataTable(tbl, {
            ordering: false,
            scrollY: '65vh',
            scrollCollapse: true,
            pageLength: 25,
            layout: {
                bottomStart: 'info',
                bottomEnd: [{
                    pageLength: {
                        menu: [10, 25, 50]
                    }
                }, 'paging']
            },
            columnDefs: [
                { targets: [0], visible: false }
            ],
            rowGroup: {
                dataSrc: 0
            }
        });
    });

    const startDate = document.getElementById('start-month');
    const endDate = document.getElementById('end-month');

    if (startDate && endDate) {
        const toggleEndMonth = () => {
            if (startDate.value) {
                endDate.disabled = false;
            } else {
                endDate.disabled = true;
                endDate.value = '';
            }
        }
        toggleEndMonth();

        startDate && startDate.addEventListener('change', () => {
            toggleEndMonth();
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
