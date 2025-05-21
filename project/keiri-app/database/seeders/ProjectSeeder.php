<?php

namespace Database\Seeders;

use App\Enums\ProjectPriority;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project1 = new Project();
        $project1->project_code = 'SFDC-WOWOW';
        $project1->project_name = 'SFDC-WOWOW';
        $project1->project_start_date = '2024-11-24';
        $project1->project_end_date = '2024-12-31';
        $project1->phase = 1;
        $project1->priority = ProjectPriority::MEDIUM;
        $project1->status = ProjectStatus::IN_PROGRESS;
        $project1->note = 'Make data integration between new CRM system(SalesForce) and current CRM system(Wism/Logica).';
        $project1->save();

        $project2 = new Project();
        $project2->project_code = 'SFDC-NGB';
        $project2->project_name = 'SFDC-NGB';
        $project2->project_start_date = '2024-09-01';
        $project2->project_end_date = '2024-12-31';
        $project2->phase = 1;
        $project2->priority = ProjectPriority::MEDIUM;
        $project2->status = ProjectStatus::IN_PROGRESS;
        $project2->note = 'Build Call-Center system for banking company';
        $project2->save();

        $project3 = new Project();
        $project3->project_code = 'MIETEN-RD';
        $project3->project_name = 'mieten R&D';
        $project3->project_start_date = '2024-09-01';
        $project3->project_end_date = '2024-12-31';
        $project3->phase = 1;
        $project3->priority = ProjectPriority::MEDIUM;
        $project3->status = ProjectStatus::IN_PROGRESS;
        $project3->note = 'Research and make prototype for adding new functionalities to mieten(security software)';
        $project3->save();

        $project4 = new Project();
        $project4->project_code = 'MIETEN-STEP2';
        $project4->project_name = 'mieten Step2';
        $project4->project_start_date = '2025-01-01';
        $project4->project_end_date = '2025-03-30';
        $project4->phase = 2;
        $project4->priority = ProjectPriority::MEDIUM;
        $project4->status = ProjectStatus::IN_PROGRESS;
        $project4->note = 'Add new functions which will be fixed in mieten R&D';
        $project4->save();

        $project5 = new Project();
        $project5->project_code = 'DOCOMO-DATA';
        $project5->project_name = 'docomo data handling system';
        $project5->project_start_date = '2024-07-01';
        $project5->project_end_date = '2024-11-30';
        $project5->phase = 1;
        $project5->priority = ProjectPriority::MEDIUM;
        $project5->status = ProjectStatus::IN_PROGRESS;
        $project5->note = 'Add new functionality(get user support data) to docomo remote support system.';
        $project5->save();

        $project6 = new Project();
        $project6->project_code = 'DOCOMO-MESSAGE';
        $project6->project_name = 'docomo message system development';
        $project6->project_start_date = '2024-08-01';
        $project6->project_end_date = '2024-10-31';
        $project6->phase = 1;
        $project6->priority = ProjectPriority::MEDIUM;
        $project6->status = ProjectStatus::IN_PROGRESS;
        $project6->note = 'Add new functionality(message sending/managing system to docomo remote support system.';
        $project6->save();

        $project7 = new Project();
        $project7->project_code = 'FSVM';
        $project7->project_name = 'FSVM system development';
        $project7->project_start_date = '2024-08-01';
        $project7->project_end_date = '2025-03-31';
        $project7->phase = 1;
        $project7->priority = ProjectPriority::MEDIUM;
        $project7->status = ProjectStatus::IN_PROGRESS;
        $project7->note = 'Develop chat functionality to FSVM system.';
        $project7->save();

        $project8 = new Project();
        $project8->project_code = 'VAC';
        $project8->project_name = 'VAC';
        $project8->project_start_date = '2024-11-01';
        $project8->project_end_date = '2025-10-01';
        $project8->phase = 1;
        $project8->priority = ProjectPriority::MEDIUM;
        $project8->status = ProjectStatus::IN_PROGRESS;
        $project8->note = 'Transfer the development tasks from another company.';
        $project8->save();

        $project9 = new Project();
        $project9->project_code = 'CIMA';
        $project9->project_name = 'CiMA project';
        $project9->project_start_date = '2024-09-01';
        $project9->project_end_date = '2024-12-31';
        $project9->phase = 1;
        $project9->priority = ProjectPriority::MEDIUM;
        $project9->status = ProjectStatus::IN_PROGRESS;
        $project9->note = 'Do the test of docomo applications.';
        $project9->save();

        $project10 = new Project();
        $project10->project_code = 'KOKEN';
        $project10->project_name = 'Add new function to Koken System';
        $project10->project_start_date = '2024-01-01';
        $project10->project_end_date = '2024-12-31';
        $project10->phase = 1;
        $project10->priority = ProjectPriority::MEDIUM;
        $project10->status = ProjectStatus::IN_PROGRESS;
        $project10->note = 'Add new functionalities to Koken system.';
        $project10->save();

        $project11 = new Project();
        $project11->project_code = 'BIP';
        $project11->project_name = 'BIP Japan internal system';
        $project11->project_start_date = '2024-09-01';
        $project11->project_end_date = '2024-12-31';
        $project11->phase = 1;
        $project11->priority = ProjectPriority::MEDIUM;
        $project11->status = ProjectStatus::IN_PROGRESS;
        $project11->note = 'Develop the HR system';
        $project11->save();

        $project12 = new Project();
        $project12->project_code = 'RSS';
        $project12->project_name = 'RSS development';
        $project12->project_start_date = '2024-04-01';
        $project12->project_end_date = '2025-04-30';
        $project12->phase = 1;
        $project12->priority = ProjectPriority::MEDIUM;
        $project12->status = ProjectStatus::IN_PROGRESS;
        $project12->note = 'Check the impact for RSS system for upgrading the software version and maintain the program.';
        $project12->save();
    }
}
