<?php

namespace Database\Seeders;

use App\Models\ProjectAssignment;
use Illuminate\Database\Seeder;

class ProjectAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Team with project 1. */
        $projectAssign1 = new ProjectAssignment();
        $projectAssign1->user_id = 2;
        $projectAssign1->project_id = 1;
        $projectAssign1->is_manager = true;
        $projectAssign1->status = 1;
        $projectAssign1->save();

        $projectAssign2 = new ProjectAssignment();
        $projectAssign2->user_id = 6;
        $projectAssign2->project_id = 1;
        $projectAssign2->status = 1;
        $projectAssign2->save();

        $projectAssign3 = new ProjectAssignment();
        $projectAssign3->user_id = 7;
        $projectAssign3->project_id = 1;
        $projectAssign3->status = 1;
        $projectAssign3->save();

        $projectAssign4 = new ProjectAssignment();
        $projectAssign4->user_id = 8;
        $projectAssign4->project_id = 1;
        $projectAssign4->status = 1;
        $projectAssign4->save();

        $projectAssign5 = new ProjectAssignment();
        $projectAssign5->user_id = 9;
        $projectAssign5->project_id = 1;
        $projectAssign5->status = 1;
        $projectAssign5->save();

        /* Team with project 2. */
        $projectAssign6 = new ProjectAssignment();
        $projectAssign6->user_id = 2;
        $projectAssign6->project_id = 2;
        $projectAssign6->is_manager = true;
        $projectAssign6->status = 1;
        $projectAssign6->save();

        $projectAssign7 = new ProjectAssignment();
        $projectAssign7->user_id = 10;
        $projectAssign7->project_id = 2;
        $projectAssign7->status = 1;
        $projectAssign7->save();

        $projectAssign8 = new ProjectAssignment();
        $projectAssign8->user_id = 11;
        $projectAssign8->project_id = 2;
        $projectAssign8->status = 1;
        $projectAssign8->save();

        $projectAssign9 = new ProjectAssignment();
        $projectAssign9->user_id = 9;
        $projectAssign9->project_id = 2;
        $projectAssign9->status = 1;
        $projectAssign9->save();

        /* Team with project 3. */
        $projectAssign6 = new ProjectAssignment();
        $projectAssign6->user_id = 3;
        $projectAssign6->project_id = 3;
        $projectAssign6->is_manager = true;
        $projectAssign6->status = 1;
        $projectAssign6->save();

        $projectAssign7 = new ProjectAssignment();
        $projectAssign7->user_id = 12;
        $projectAssign7->project_id = 3;
        $projectAssign7->status = 1;
        $projectAssign7->save();

        $projectAssign8 = new ProjectAssignment();
        $projectAssign8->user_id = 13;
        $projectAssign8->project_id = 3;
        $projectAssign8->status = 1;
        $projectAssign8->save();

        $projectAssign9 = new ProjectAssignment();
        $projectAssign9->user_id = 14;
        $projectAssign9->project_id = 3;
        $projectAssign9->status = 1;
        $projectAssign9->save();
    }
}
