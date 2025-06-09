'use strict';
import 'bootstrap/js/dist/tab';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-rowgroup-bs5';
import flatpickr from 'flatpickr';
import monthSelectPlugin from '../plugins/flatpickr/monthSelect/index.js';
import Choices from "choices.js";

document.addEventListener('DOMContentLoaded', () => {
    const tblReportMonthlyPaymentRequest = document.querySelectorAll('.report-monthly_payment_request');
    tblReportMonthlyPaymentRequest.forEach((tbl) => {
        new DataTable(tbl, {
            ordering: false,
            scrollY: '100vh',
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
                {targets: [0], visible: false}
            ],
            rowGroup: {
                dataSrc: 0
            }
        });
    });

    /*  */
    document.getElementById('update-preview-report')?.addEventListener('click', (e) => {
        e.preventDefault();
        const inpStartMonth = document.getElementById('id-start_month');
        const inpEndMonth = document.getElementById('id-end_month');

        if (!inpStartMonth || !inpEndMonth) {
            return;
        }

        const startValue = inpStartMonth.value.trim();
        const endValue = inpEndMonth.value.trim();

        if (!startValue || !endValue) {
            return;
        }

        document.getElementById('term-form')?.submit();
    });

    let startPicker, endPicker;
    const inpStartMonth = document.getElementById('id-start_month');

    if (inpStartMonth) {
        startPicker = flatpickr(inpStartMonth, {
            plugins: [
                 monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "F Y",
                    altFormat: "F Y",
                    theme: sessionStorage.getItem('data-bs-theme') ?? 'light',
                })
            ],
            defaultDate: new Date(),
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0 && endPicker) {
                    console.log(endPicker)
                    const startDate = selectedDates[0];
                    const startYear = startDate.getFullYear();

                    // Giới hạn minDate và maxDate của end_month
                    const minDate = new Date(startYear, startDate.getMonth(), 1);
                    const maxDate = new Date(startYear, 11, 1);
                    endPicker.set('minDate', minDate);
                    endPicker.set('maxDate', maxDate);

                    // Nếu chưa chọn hoặc sai năm hoặc < start, thì set lại bằng start.
                    const endDate = endPicker.selectedDates[0];
                    if (!endDate || endDate.getFullYear() !== startYear || endDate < startDate) {
                        endPicker.setDate(minDate, true);
                    }
                }
            },
            onReady: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0 && endPicker) {
                    const startDate = selectedDates[0];
                    const startYear = startDate.getFullYear();
                    const startMonth = startDate.getMonth();

                    const minDate = new Date(startYear, startMonth, 1);
                    const maxDate = new Date(startYear, 11, 31);

                    endPicker.set('minDate', minDate);
                    endPicker.set('maxDate', maxDate);

                    const endDate = endPicker.selectedDates[0];
                    if (!endDate || endDate.getFullYear() !== startYear || endDate < startDate) {
                        endPicker.setDate(minDate, true);
                    }
                }
            },
        });
    }

    const inpEndMonth = document.getElementById('id-end_month');
    if (inpEndMonth) {
        endPicker = flatpickr(inpEndMonth, {
            plugins: [
                 monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "F Y",
                    altFormat: "F Y",
                    theme: sessionStorage.getItem('data-bs-theme') ?? 'light'
                })
            ],
            nextArrow: null,
            prevArrow: null,
            defaultDate: new Date(),
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0 && startPicker && startPicker.selectedDates.length > 0) {
                    const endDate = selectedDates[0];
                    const startDate = startPicker.selectedDates[0];
                    const startYear = startDate.getFullYear();
                    const endYear = endDate.getFullYear();
                    const minDate = new Date(startYear, startDate.getMonth(), 1);

                    // Reset lại về start nếu năm khác hoặc nhỏ hơn.
                    if (endYear !== startYear || endDate < startDate) {
                        instance.setDate(minDate, true);
                    }
                }
            },
            onReady: function (selectedDates, dateStr, instance) {
                if (startPicker && startPicker.selectedDates.length > 0) {
                    const startDate = startPicker.selectedDates[0];
                    const minDate = new Date(startDate.getFullYear(), startDate.getMonth(), 1);
                    const maxDate = new Date(startDate.getFullYear(), 11, 1);
                    instance.set('minDate', minDate);
                    instance.set('maxDate', maxDate);

                    const endDate = selectedDates[0];
                    if (!endDate || endDate.getFullYear() !== startDate.getFullYear() || endDate < startDate) {
                        instance.setDate(minDate, true);
                    }
                }
            }
        });
    }

    /* Multiple project assign. */
    const projects = document.getElementById('projects');
    if (projects) {
        new Choices(projects, {
            removeItems: true,
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'Select projects',
            noChoicesText: 'No projects available',
        });
    }
});
