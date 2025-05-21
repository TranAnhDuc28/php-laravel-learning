<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class DepartmentSelect extends Component
{
    public $departmentId;
    public $selectedTenantId;

    /**
     * @return Factory|View|Application|object
     */
    public function render()
    {
        $departments = Department::all();

        $dataView = [
            'departments' => $departments,
        ];

        return view('livewire.department-select', $dataView);
    }
}
