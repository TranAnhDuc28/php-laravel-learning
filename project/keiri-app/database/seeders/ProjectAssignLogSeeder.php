<?php

namespace Database\Seeders;

use App\Models\ProjectAssignment;
use App\Models\ProjectAssignmentLog;
use Illuminate\Database\Seeder;

class ProjectAssignLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Log project assign for project 1. */
        $projectAssignLog1 = new ProjectAssignmentLog();
        $projectAssignLog1->user_id = 2;
        $projectAssignLog1->project_id = 1;
        $projectAssignLog1->project_assignment_id = 1;
        $projectAssignLog1->project_join_date = '2024-11-24';
        $projectAssignLog1->project_exit_date = null;
        $projectAssignLog1->save();

        $projectAssignLog2 = new ProjectAssignmentLog();
        $projectAssignLog2->user_id = 6;
        $projectAssignLog2->project_id = 1;
        $projectAssignLog2->project_assignment_id = 2;
        $projectAssignLog2->project_join_date = '2024-11-24';
        $projectAssignLog2->project_exit_date = null;
        $projectAssignLog2->save();

        $projectAssignLog3 = new ProjectAssignmentLog();
        $projectAssignLog3->user_id = 7;
        $projectAssignLog3->project_id = 1;
        $projectAssignLog3->project_assignment_id = 3;
        $projectAssignLog3->project_join_date = '2024-11-24';
        $projectAssignLog3->project_exit_date = null;
        $projectAssignLog3->save();

        $projectAssignLog4 = new ProjectAssignmentLog();
        $projectAssignLog4->user_id = 8;
        $projectAssignLog4->project_id = 1;
        $projectAssignLog4->project_assignment_id = 4;
        $projectAssignLog4->project_join_date = '2024-11-24';
        $projectAssignLog4->project_exit_date = null;
        $projectAssignLog4->save();

        $projectAssignLog5 = new ProjectAssignmentLog();
        $projectAssignLog5->user_id = 9;
        $projectAssignLog5->project_id = 1;
        $projectAssignLog5->project_assignment_id = 5;
        $projectAssignLog5->project_join_date = '2024-11-24';
        $projectAssignLog5->project_exit_date = '2024-11-29';
        $projectAssignLog5->worked_days = 5;
        $projectAssignLog5->save();

        $projectAssignLog6 = new ProjectAssignmentLog();
        $projectAssignLog6->user_id = 9;
        $projectAssignLog6->project_id = 1;
        $projectAssignLog6->project_assignment_id = 5;
        $projectAssignLog6->project_join_date = '2024-12-16';
        $projectAssignLog6->project_exit_date = null;
        $projectAssignLog6->save();
    }
}
