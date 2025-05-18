'use strict';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';

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
            {targets: 3, type: 'string'},
            {targets: 9, orderable: false},
        ],
        fixedColumns: {
            left: 2,
            right: 1,
        },
        fixedHeader: true,
    });

    let dtInpSearch = document.querySelector('.dt-search input');
    dtInpSearch?.classList.remove('form-control-sm');
});



