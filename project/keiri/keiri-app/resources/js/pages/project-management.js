'use strict';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import flatpickr from 'flatpickr';
import Choices from "choices.js";
import Modal from 'bootstrap/js/dist/modal';

document.addEventListener('DOMContentLoaded', () => {
    /* Init table project. */
    const tblProjectList = document.getElementById('project_list');
    tblProjectList && new DataTable(tblProjectList, {
        scrollY: '65vh',
        scrollX: true,
        scrollCollapse: true,
        layout: {
            topStart: {
                search: {
                    text: '',
                    placeholder: 'Search...',
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
            {targets: 5, type: 'string'},
            {targets: 6, width: 500, className: 'text-wrap'},
        ],
        fixedColumns: {
            left: 3
        },
        fixedHeader: true,
    });

    /* Init table project assign. */
    const tblProjectListAssign = document.getElementById('project_assign_list');
    tblProjectListAssign && new DataTable(tblProjectListAssign, {
        scrollY: '65vh',
        scrollX: true,
        scrollCollapse: true,
        layout: {
            topStart: {
                search: {
                    text: '',
                    placeholder: 'Search...',
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
            {targets: 3, orderable: false},
            {targets: 4, width: '5%', orderable: false},
        ],
        fixedHeader: true,
    });

    document.querySelector('.dt-search input')?.classList.remove('form-control-sm');

    /* Init input type date. */
    const inpProjectStartDate = document.getElementById('id-project_start_date');
    inpProjectStartDate && flatpickr(inpProjectStartDate, {
        enableTime: false,
        dateFormat: 'd-m-Y',
        allowInput: true
    });

    const inpProjectEndDate = document.getElementById('id-project_end_date');
    inpProjectEndDate && flatpickr(inpProjectEndDate, {
        enableTime: false,
        dateFormat: 'd-m-Y',
        allowInput: true
    });

    const inpDateMemberJoinedDates = document.querySelectorAll('.project_join_date');
    inpDateMemberJoinedDates.forEach((inp) => {
        flatpickr(inp, {
            enableTime: false,
            dateFormat: 'd-m-Y',
            allowInput: true
        });
    });

    const inpDateMemberExitDates = document.querySelectorAll('.project_exit_date');
    inpDateMemberExitDates.forEach((inp) => {
        flatpickr(inp, {
            enableTime: false,
            dateFormat: 'd-m-Y',
            allowInput: true
        });
    });

    /* Switch create project. */
    const formCreateProject = document.querySelector('.form-create-project');
    const formSelectExistingProject = document.querySelector('.form-select-existing-project');
    document.getElementById('switchUseExistingProject')?.addEventListener('change', (e) => {
        if (e.target.checked) {
            formCreateProject?.classList.add('d-none');
            formSelectExistingProject?.classList.remove('d-none');
        } else {
            formCreateProject?.classList.remove('d-none');
            formSelectExistingProject?.classList.add('d-none');
        }
    });

    /* Multiple project assign. */
    const teamMembers = document.getElementById('team-members');
    if (teamMembers) {
        new Choices(teamMembers, {
            removeItems: true,
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'Select team members',
            noChoicesText: 'No members available',
        });
    }

    // /**
    //  * Calculate worked day.
    //  */
    // const calculateWorkedDays = () => {
    //     if (!joinDateInput || !exitDateInput) {
    //         document.getElementById("workedDays").value = 0;
    //         return;
    //     }
    //
    //     const joinDate = new Date(joinDateInput);
    //     const exitDate = new Date(exitDateInput);
    //
    //     if (joinDate > exitDate) {
    //         document.getElementById("workedDays").value = 0;
    //         return;
    //     }
    //
    //     let workDays = 0;
    //     const currentDate = new Date(joinDate);
    //
    //     while (currentDate <= exitDate) {
    //         const day = currentDate.getDay(); // 0 = Sunday, 6 = Saturday
    //         if (day !== 0 && day !== 6) {
    //             workDays++;
    //         }
    //         currentDate.setDate(currentDate.getDate() + 1);
    //     }
    //
    //     document.getElementById("workedDays").value = workDays;
    // }
    // document.getElementById("joinDate").addEventListener("change", calculateWorkedDays);
    // document.getElementById("exitDate").addEventListener("change", calculateWorkedDays);

    /**
     * Delete log with modal.
     * @param actionForm
     */
    const openDeleteModal = (actionForm) => {
        const form = document.getElementById('deleteLogForm');
        form.action = actionForm;
        const modal = new Modal(document.getElementById('deleteLogModal'));
        modal.show();
    }

    document.querySelectorAll('.btn-delete-assign-log')?.forEach(a => {
        a.addEventListener('click', (e) => {
            e.preventDefault();
            const actionForm = a.href;
            openDeleteModal(actionForm);
        });
    });
});



