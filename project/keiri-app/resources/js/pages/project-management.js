'use strict';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import flatpickr from 'flatpickr';
import 'tom-select';
import Choices from "choices.js";

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
            {targets: 8, width: 500, className: 'text-wrap'},
            {targets: 9, orderable: false},
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
    const inpProjectStartDate = document.getElementById('id-project-start-date');
    inpProjectStartDate && flatpickr(inpProjectStartDate, {
        enableTime: false,
        dateFormat: 'd-m-Y',
    });

    const inpProjectEndDate = document.getElementById('id-project-end-date');
    inpProjectEndDate && flatpickr(inpProjectEndDate, {
        enableTime: false,
        dateFormat: 'd-m-Y',
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

    // Submit.
    document.getElementById('btn-save-project')?.addEventListener('click', (e) => {
        e.preventDefault();
        const form = {
            'use_existing_project': document.getElementById('switchUseExistingProject')?.checked,
            'project_code': document.getElementById('id-project-code')?.value,
            'project_name': document.getElementById('id-project-name')?.value,
            'project_start_date': document.getElementById('id-project-start-date')?.value,
            'project_end_date': document.getElementById('id-project-end-date')?.value,
            'phase': document.getElementById('id-phase')?.value,
            'priority': document.getElementById('id-priority')?.value,
            'status': document.getElementById('id-project-status')?.value,
        };
        console.log(form);
    });

    /* Multiple project assign. */
    const teamMembers = document.getElementById('team-members');
    if (teamMembers) {
        const teamMembersChoices = new Choices(teamMembers, {
            removeItems: true,
            removeItemButton: true,
            placeholderValue: 'Select team members',
            noChoicesText: 'No members available',
        });

        teamMembers.addEventListener('change', function () {
            const selectedOptions = teamMembersChoices.getValue();
            console.log('Selected options:', selectedOptions);
            renderTeamMembersForm(selectedOptions);
        });

        /**
         * Render form create project assign members
         * @param selectedOptions
         */
        const renderTeamMembersForm = (selectedOptions) => {
            const teamMemberForm = document.getElementById('team-members-form');
            if (teamMemberForm) {
                const fragment = document.createDocumentFragment();
                teamMemberForm.innerHTML = '';

                selectedOptions.forEach(option => {
                    const div = document.createElement('div');
                    div.className = 'row mb-3 d-flex align-items-center';
                    div.innerHTML = `
                        <input type="hidden" class="form-control" name="user_id" value="${option.value}" readonly disabled>
                        <div class="col-lg-3 mt-1">
                            <input type="text" class="form-control" value="${option.label}" readonly disabled>
                        </div>
                        <div class="col-lg-2 mt-1">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_manager[${option.value}]">
                                <label class="form-check-label">Manager</label>
                            </div>
                        </div>
                        <div class="col-lg-7 mt-1">
                              <textarea class="form-control" rows="1" placeholder="Note" maxlength="1000"></textarea>
                        </div>
                    `;
                    fragment.appendChild(div);
                });

                teamMemberForm.appendChild(fragment);
            }
        }

        const initialValues = teamMembersChoices.getValue();
        if (initialValues.length > 0) {
            renderTeamMembersForm(initialValues);
        }
    }
});



