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

    /* Preview report monthly payment report. */
    let startPicker, endPicker;
    const inpStartMonth = document.getElementById('id-start_month');
    const inpEndMonth = document.getElementById('id-end_month');
    const btnUpdatePreviewReport = document.getElementById('update-preview-report');
    const btnExportReport = document.getElementById('export-report');

    /* Function validate range month. */
    const validateRangeMonth = () => {
        if (!inpStartMonth || !inpEndMonth) {
            return false;
        }

        const startValue = inpStartMonth.value.trim();
        const endValue = inpEndMonth.value.trim();

        if (!startValue || !endValue) {
            return false;
        }

        return true;
    };

    btnExportReport?.addEventListener('click', (e) => {
        e.preventDefault();

        if (validateRangeMonth()) {
            const termForm = document.getElementById('term-form');

            if (termForm) {
                termForm.action = urlExportMonthlyPaymentRequest;
                termForm.submit();
            }
        }
    });

    btnUpdatePreviewReport?.addEventListener('click', (e) => {
        e.preventDefault();

        if (validateRangeMonth()) {
            const termForm = document.getElementById('term-form');

            if (termForm) {
                termForm.action = urlShowMonthlyPaymentRequest;
                termForm.submit();
            }
        }
    });

    const parseDateString = (dateStr) => {
        if (!dateStr) return null;
        try {
            return new Date(`${dateStr} 1`);
        } catch (e) {
            console.error("Invalid date format:", dateStr);
            return new Date();
        }
    }

    if (inpStartMonth) {
        const startValue = inpStartMonth.value;
        const defaultStartDate = startValue ? parseDateString(startValue) : new Date();

        startPicker = flatpickr(inpStartMonth, {
            plugins: [
                monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "F Y",
                    altFormat: "F Y",
                    theme: sessionStorage.getItem('data-bs-theme') ?? 'light',
                })
            ],
            defaultDate: defaultStartDate,
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0 && endPicker) {
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

    if (inpEndMonth) {
        const endValue = inpEndMonth.value;
        const defaultEndDate = endValue ? parseDateString(endValue) : new Date();

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
            defaultDate: defaultEndDate,
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
