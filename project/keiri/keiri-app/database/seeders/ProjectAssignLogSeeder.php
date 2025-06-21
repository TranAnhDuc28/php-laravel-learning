<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectAssignmentLog;
use Illuminate\Database\Seeder;

class ProjectAssignLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $project1 = $projects->firstWhere('id', 1);
//        $project2 = $projects->firstWhere('id', 2);
//        $project3 = $projects->firstWhere('id', 3);
//        $project4 = $projects->firstWhere('id', 4);
//        $project5 = $projects->firstWhere('id', 5);
//        $project6 = $projects->firstWhere('id', 6);
//        $project7 = $projects->firstWhere('id', 7);
//        $project8 = $projects->firstWhere('id', 8);
//        $project9 = $projects->firstWhere('id', 9);
//        $project10 = $projects->firstWhere('id', 10);
//        $project11 = $projects->firstWhere('id', 11);
//        $project12 = $projects->firstWhere('id', 12);

//        /* Log project assign for project 1. */
//        $projectAssignLog1 = new ProjectAssignmentLog();
//        $projectAssignLog1->user_id = 2;
//        $projectAssignLog1->project_id = $project1->id;
//        $projectAssignLog1->project_assignment_id = 1;
//        $projectAssignLog1->project_join_date = $project1->project_start_date;
//        $projectAssignLog1->project_exit_date = null;
//        $projectAssignLog1->effort_percentage = 50;
//        $projectAssignLog1->save();
//
//        $projectAssignLog2 = new ProjectAssignmentLog();
//        $projectAssignLog2->user_id = 6;
//        $projectAssignLog2->project_id = $project1->id;
//        $projectAssignLog2->project_assignment_id = 2;
//        $projectAssignLog2->project_join_date = $project1->project_start_date;
//        $projectAssignLog2->project_exit_date = null;
//        $projectAssignLog2->save();
//
//        $projectAssignLog3 = new ProjectAssignmentLog();
//        $projectAssignLog3->user_id = 20;
//        $projectAssignLog3->project_id = $project1->id;
//        $projectAssignLog3->project_assignment_id = 3;
//        $projectAssignLog3->project_join_date = $project1->project_start_date;
//        $projectAssignLog3->project_exit_date = null;
//        $projectAssignLog3->save();
//
//        $projectAssignLog4 = new ProjectAssignmentLog();
//        $projectAssignLog4->user_id = 23;
//        $projectAssignLog4->project_id = $project1->id;
//        $projectAssignLog4->project_assignment_id = 4;
//        $projectAssignLog4->project_join_date = $project1->project_start_date;
//        $projectAssignLog4->project_exit_date = null;
//        $projectAssignLog4->save();
//
//        $projectAssignLog5 = new ProjectAssignmentLog();
//        $projectAssignLog5->user_id = 26;
//        $projectAssignLog5->project_id = $project1->id;
//        $projectAssignLog5->project_assignment_id = 5;
//        $projectAssignLog5->project_join_date = $project1->project_start_date;
//        $projectAssignLog5->project_exit_date = '2024-11-29';
//        $projectAssignLog5->working_days = 5;
//        $projectAssignLog5->save();
//
//        $projectAssignLog6 = new ProjectAssignmentLog();
//        $projectAssignLog6->user_id = 26;
//        $projectAssignLog6->project_id = $project1->id;
//        $projectAssignLog6->project_assignment_id = 5;
//        $projectAssignLog6->project_join_date = '2024-12-16';
//        $projectAssignLog6->project_exit_date = null;
//        $projectAssignLog6->effort_percentage = 50;
//        $projectAssignLog6->save();

        /* Log project assign for project 2. */
//        $projectAssignLog7 = new ProjectAssignmentLog();
//        $projectAssignLog7->user_id = 2;
//        $projectAssignLog7->project_id = $project2->id;
//        $projectAssignLog7->project_assignment_id = 6;
//        $projectAssignLog7->project_join_date = $project2->project_start_date;
//        $projectAssignLog7->project_exit_date = null;
//        $projectAssignLog7->effort_percentage = 50;
//        $projectAssignLog7->save();
//
//        $projectAssignLog8 = new ProjectAssignmentLog();
//        $projectAssignLog8->user_id = 11;
//        $projectAssignLog8->project_id = $project2->id;
//        $projectAssignLog8->project_assignment_id = 7;
//        $projectAssignLog8->project_join_date = $project2->project_start_date;
//        $projectAssignLog8->project_exit_date = null;
//        $projectAssignLog8->save();
//
//        $projectAssignLog9 = new ProjectAssignmentLog();
//        $projectAssignLog9->user_id = 12;
//        $projectAssignLog9->project_id = $project2->id;
//        $projectAssignLog9->project_assignment_id = 8;
//        $projectAssignLog9->project_join_date = $project2->project_start_date;
//        $projectAssignLog9->project_exit_date = null;
//        $projectAssignLog9->save();
//
//        $projectAssignLog10 = new ProjectAssignmentLog();
//        $projectAssignLog10->user_id = 26;
//        $projectAssignLog10->project_id = $project2->id;
//        $projectAssignLog10->project_assignment_id = 9;
//        $projectAssignLog10->project_join_date = '2024-12-16';
//        $projectAssignLog10->project_exit_date = null;
//        $projectAssignLog10->effort_percentage = 50;
//        $projectAssignLog10->save();

//        /* Log project assign for project 3. */
//        $projectAssignLog11 = new ProjectAssignmentLog();
//        $projectAssignLog11->user_id = 4;
//        $projectAssignLog11->project_id = $project3->id;
//        $projectAssignLog11->project_assignment_id = 10;
//        $projectAssignLog11->project_join_date = $project3->project_start_date;
//        $projectAssignLog11->project_exit_date = null;
//        $projectAssignLog11->effort_percentage = 70;
//        $projectAssignLog11->save();
//
//        $projectAssignLog12 = new ProjectAssignmentLog();
//        $projectAssignLog12->user_id = 13;
//        $projectAssignLog12->project_id = $project3->id;
//        $projectAssignLog12->project_assignment_id = 11;
//        $projectAssignLog12->project_join_date = $project3->project_start_date;
//        $projectAssignLog12->project_exit_date = null;
//        $projectAssignLog12->save();
//
//        $projectAssignLog13 = new ProjectAssignmentLog();
//        $projectAssignLog13->user_id = 25;
//        $projectAssignLog13->project_id = $project3->id;
//        $projectAssignLog13->project_assignment_id = 12;
//        $projectAssignLog13->project_join_date = $project3->project_start_date;
//        $projectAssignLog13->project_exit_date = null;
//        $projectAssignLog13->effort_percentage = 70;
//        $projectAssignLog13->save();
//
//        /* Log project assign for project 4. */
//        $projectAssignLog14 = new ProjectAssignmentLog();
//        $projectAssignLog14->user_id = 4;
//        $projectAssignLog14->project_id = $project4->id;
//        $projectAssignLog14->project_assignment_id = 13;
//        $projectAssignLog14->project_join_date = $project4->project_start_date;
//        $projectAssignLog14->project_exit_date = null;
//        $projectAssignLog14->effort_percentage = 70;
//        $projectAssignLog14->save();
//
//        $projectAssignLog15 = new ProjectAssignmentLog();
//        $projectAssignLog15->user_id = 13;
//        $projectAssignLog15->project_id = $project4->id;
//        $projectAssignLog15->project_assignment_id = 14;
//        $projectAssignLog15->project_join_date = $project4->project_start_date;
//        $projectAssignLog15->project_exit_date = null;
//        $projectAssignLog15->save();
//
//        $projectAssignLog16 = new ProjectAssignmentLog();
//        $projectAssignLog16->user_id = 22;
//        $projectAssignLog16->project_id = $project4->id;
//        $projectAssignLog16->project_assignment_id = 15;
//        $projectAssignLog16->project_join_date = $project4->project_start_date;
//        $projectAssignLog16->project_exit_date = null;
//        $projectAssignLog16->save();
//
//        $projectAssignLog17 = new ProjectAssignmentLog();
//        $projectAssignLog17->user_id = 25;
//        $projectAssignLog17->project_id = $project4->id;
//        $projectAssignLog17->project_assignment_id = 16;
//        $projectAssignLog17->project_join_date = $project4->project_start_date;
//        $projectAssignLog17->project_exit_date = null;
//        $projectAssignLog17->effort_percentage = 80;
//        $projectAssignLog17->save();
//
//        /* Log project assign for project 5. */
//        $projectAssignLog18 = new ProjectAssignmentLog();
//        $projectAssignLog18->user_id = 9;
//        $projectAssignLog18->project_id = $project5->id;
//        $projectAssignLog18->project_assignment_id = 17;
//        $projectAssignLog18->project_join_date = $project5->project_start_date;
//        $projectAssignLog18->project_exit_date = null;
//        $projectAssignLog18->save();
//
//        /* Log project assign for project 6. */
//        $projectAssignLog19 = new ProjectAssignmentLog();
//        $projectAssignLog19->user_id = 9;
//        $projectAssignLog19->project_id = $project6->id;
//        $projectAssignLog19->project_assignment_id = 18;
//        $projectAssignLog19->project_join_date = $project6->project_start_date;
//        $projectAssignLog19->project_exit_date = null;
//        $projectAssignLog19->save();
//
//        $projectAssignLog20 = new ProjectAssignmentLog();
//        $projectAssignLog20->user_id = 13;
//        $projectAssignLog20->project_id = $project6->id;
//        $projectAssignLog20->project_assignment_id = 19;
//        $projectAssignLog20->project_join_date = $project6->project_start_date;
//        $projectAssignLog20->project_exit_date = null;
//        $projectAssignLog20->save();
//
//        /* Log project assign for project 7. */
//        $projectAssignLog21 = new ProjectAssignmentLog();
//        $projectAssignLog21->user_id = 3;
//        $projectAssignLog21->project_id = $project7->id;
//        $projectAssignLog21->project_assignment_id = 20;
//        $projectAssignLog21->project_join_date = $project7->project_start_date;
//        $projectAssignLog21->project_exit_date = null;
//        $projectAssignLog21->save();
//
//        $projectAssignLog22 = new ProjectAssignmentLog();
//        $projectAssignLog22->user_id = 7;
//        $projectAssignLog22->project_id = $project7->id;
//        $projectAssignLog22->project_assignment_id = 21;
//        $projectAssignLog22->project_join_date = $project7->project_start_date;
//        $projectAssignLog22->project_exit_date = null;
//        $projectAssignLog22->save();
//
//        $projectAssignLog23 = new ProjectAssignmentLog();
//        $projectAssignLog23->user_id = 15;
//        $projectAssignLog23->project_id = $project7->id;
//        $projectAssignLog23->project_assignment_id = 22;
//        $projectAssignLog23->project_join_date = $project7->project_start_date;
//        $projectAssignLog23->project_exit_date = null;
//        $projectAssignLog23->save();
//
//        $projectAssignLog24 = new ProjectAssignmentLog();
//        $projectAssignLog24->user_id = 18;
//        $projectAssignLog24->project_id = $project7->id;
//        $projectAssignLog24->project_assignment_id = 23;
//        $projectAssignLog24->project_join_date = $project7->project_start_date;
//        $projectAssignLog24->project_exit_date = null;
//        $projectAssignLog24->save();
//
//        $projectAssignLog25 = new ProjectAssignmentLog();
//        $projectAssignLog25->user_id = 23;
//        $projectAssignLog25->project_id = $project7->id;
//        $projectAssignLog25->project_assignment_id = 24;
//        $projectAssignLog25->project_join_date = $project7->project_start_date;
//        $projectAssignLog25->project_exit_date = null;
//        $projectAssignLog25->save();
//
//        $projectAssignLog26 = new ProjectAssignmentLog();
//        $projectAssignLog26->user_id = 26;
//        $projectAssignLog26->project_id = $project7->id;
//        $projectAssignLog26->project_assignment_id = 25;
//        $projectAssignLog26->project_join_date = $project7->project_start_date;
//        $projectAssignLog26->project_exit_date = null;
//        $projectAssignLog26->save();
//
//        /* Log project assign for project 8. */
//        $projectAssignLog27 = new ProjectAssignmentLog();
//        $projectAssignLog27->user_id = 9;
//        $projectAssignLog27->project_id = $project8->id;
//        $projectAssignLog27->project_assignment_id = 20;
//        $projectAssignLog27->project_join_date = $project8->project_start_date;
//        $projectAssignLog27->project_exit_date = null;
//        $projectAssignLog27->save();
//
//        /* Log project assign for project 9. */
//        $projectAssignLog28 = new ProjectAssignmentLog();
//        $projectAssignLog28->user_id = 4;
//        $projectAssignLog28->project_id = $project9->id;
//        $projectAssignLog28->project_assignment_id = 27;
//        $projectAssignLog28->project_join_date = $project9->project_start_date;
//        $projectAssignLog28->project_exit_date = null;
//        $projectAssignLog28->save();
//
//        $projectAssignLog29 = new ProjectAssignmentLog();
//        $projectAssignLog29->user_id = 17;
//        $projectAssignLog29->project_id = $project9->id;
//        $projectAssignLog29->project_assignment_id = 28;
//        $projectAssignLog29->project_join_date = $project9->project_start_date;
//        $projectAssignLog29->project_exit_date = null;
//        $projectAssignLog29->save();
//
//        $projectAssignLog30 = new ProjectAssignmentLog();
//        $projectAssignLog30->user_id = 19;
//        $projectAssignLog30->project_id = $project9->id;
//        $projectAssignLog30->project_assignment_id = 29;
//        $projectAssignLog30->project_join_date = $project9->project_start_date;
//        $projectAssignLog30->project_exit_date = null;
//        $projectAssignLog30->save();
//
//        $projectAssignLog31 = new ProjectAssignmentLog();
//        $projectAssignLog31->user_id = 20;
//        $projectAssignLog31->project_id = $project9->id;
//        $projectAssignLog31->project_assignment_id = 30;
//        $projectAssignLog31->project_join_date = $project9->project_start_date;
//        $projectAssignLog31->project_exit_date = null;
//        $projectAssignLog31->save();
//
//        $projectAssignLog32 = new ProjectAssignmentLog();
//        $projectAssignLog32->user_id = 25;
//        $projectAssignLog32->project_id = $project9->id;
//        $projectAssignLog32->project_assignment_id = 31;
//        $projectAssignLog32->project_join_date = $project9->project_start_date;
//        $projectAssignLog32->project_exit_date = null;
//        $projectAssignLog13->effort_percentage = 30;
//        $projectAssignLog32->save();
//
//        /* Log project assign for project 10. */
//        $projectAssignLog33 = new ProjectAssignmentLog();
//        $projectAssignLog33->user_id = 16;
//        $projectAssignLog33->project_id = $project10->id;
//        $projectAssignLog33->project_assignment_id = 32;
//        $projectAssignLog33->project_join_date = '2024-09-01';
//        $projectAssignLog33->project_exit_date = null;
//        $projectAssignLog33->save();
//
//        /* Log project assign for project 11. */
//        $projectAssignLog34 = new ProjectAssignmentLog();
//        $projectAssignLog34->user_id = 8;
//        $projectAssignLog34->project_id = $project11->id;
//        $projectAssignLog34->project_assignment_id = 33;
//        $projectAssignLog34->project_join_date = $project11->project_start_date;
//        $projectAssignLog34->project_exit_date = null;
//        $projectAssignLog34->save();
//
//        $projectAssignLog35 = new ProjectAssignmentLog();
//        $projectAssignLog35->user_id = 14;
//        $projectAssignLog35->project_id = $project11->id;
//        $projectAssignLog35->project_assignment_id = 34;
//        $projectAssignLog35->project_join_date = $project11->project_start_date;
//        $projectAssignLog35->project_exit_date = null;
//        $projectAssignLog35->save();
//
//        /* Log project assign for project 12. */
//        $projectAssignLog36 = new ProjectAssignmentLog();
//        $projectAssignLog36->user_id = 10;
//        $projectAssignLog36->project_id = $project12->id;
//        $projectAssignLog36->project_assignment_id = 35;
//        $projectAssignLog36->project_join_date = $project12->project_start_date;
//        $projectAssignLog36->project_exit_date = null;
//        $projectAssignLog36->save();
//
//        $projectAssignLog37 = new ProjectAssignmentLog();
//        $projectAssignLog37->user_id = 22;
//        $projectAssignLog37->project_id = $project12->id;
//        $projectAssignLog37->project_assignment_id = 36;
//        $projectAssignLog37->project_join_date = '2024-09-01';
//        $projectAssignLog37->project_exit_date = null;
//        $projectAssignLog37->save();
//
//        $projectAssignLog38 = new ProjectAssignmentLog();
//        $projectAssignLog38->user_id = 26;
//        $projectAssignLog38->project_id = $project12->id;
//        $projectAssignLog38->project_assignment_id = 37;
//        $projectAssignLog38->project_join_date = '2024-09-01';
//        $projectAssignLog38->project_exit_date = null;
//        $projectAssignLog38->save();

        /* Log project assign for project 1 mock. */
        $projectAssignLog1 = new ProjectAssignmentLog();
        $projectAssignLog1->user_id = 2;
        $projectAssignLog1->project_id = $project1->id;
        $projectAssignLog1->project_assignment_id = 1;
        $projectAssignLog1->project_join_date = $project1->project_start_date;
        $projectAssignLog1->project_exit_date = null;
        $projectAssignLog1->save();

        $projectAssignLog2 = new ProjectAssignmentLog();
        $projectAssignLog2->user_id = 3;
        $projectAssignLog2->project_id = $project1->id;
        $projectAssignLog2->project_assignment_id = 2;
        $projectAssignLog2->project_join_date = $project1->project_start_date;
        $projectAssignLog2->project_exit_date = null;
        $projectAssignLog2->save();

        $projectAssignLog5 = new ProjectAssignmentLog();
        $projectAssignLog5->user_id = 4;
        $projectAssignLog5->project_id = $project1->id;
        $projectAssignLog5->project_assignment_id = 3;
        $projectAssignLog5->project_join_date = $project1->project_start_date;
        $projectAssignLog5->project_exit_date = '2024-11-29';
        $projectAssignLog5->working_days = 20;
        $projectAssignLog5->save();

        $projectAssignLog6 = new ProjectAssignmentLog();
        $projectAssignLog6->user_id = 4;
        $projectAssignLog6->project_id = $project1->id;
        $projectAssignLog6->project_assignment_id = 3;
        $projectAssignLog6->project_join_date = '2024-12-16';
        $projectAssignLog6->project_exit_date = null;
        $projectAssignLog6->save();
    }
}
