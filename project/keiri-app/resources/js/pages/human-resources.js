'use strict';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import flatpickr from "flatpickr";

document.addEventListener('DOMContentLoaded', () => {
    const table = new DataTable('#employee_list', {
        scrollY: '65vh',
        scrollX: true,
        scrollCollapse: true,
        layout: {
            topStart: {
                search: {
                    text: '',
                    placeholder: 'Search...'
                }
            },
            bottomStart: 'info',
            bottomEnd: [{
                pageLength: {
                    menu: [10, 25, 50]
                }
            }, 'paging']
        },
        columnDefs: [
            {targets: 0, width: '3%', type: 'string'},
            {targets: 1, type: 'string'},
            {targets: 2, type: 'string'},
            {targets: 3, type: 'string'},
            {targets: 4, type: 'string'},
            {targets: 5, type: 'string'},
            {targets: 6, type: 'string'},
        ],
        fixedColumns: {
            left: 3
        },
        fixedHeader: true,
    });

    document.querySelector('.dt-search input')?.classList.remove('form-control-sm');

    const inpEmployeeJoinDate = document.getElementById('id-join_date');
    inpEmployeeJoinDate && flatpickr(inpEmployeeJoinDate, {
        enableTime: false,
        dateFormat: 'd-m-Y',
    });
});



