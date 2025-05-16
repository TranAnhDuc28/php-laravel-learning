'use strict';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedcolumns';

new DataTable('#employee_list', {
    scrollX: true,
    layout: {
        topStart: {
            search: {
                placeholder: 'Search'
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
        {targets: 0, width: '5%', type: 'string'},
        {targets: 3, type: 'string'},
    ],
    fixedColumns: {
        start: 2
    }
});

