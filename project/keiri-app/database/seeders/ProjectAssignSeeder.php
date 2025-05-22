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
        /* Team with project 'SFDC-WOWOW'. */
        $projectAssign1 = new ProjectAssignment();
        $projectAssign1->user_id = 2;
        $projectAssign1->project_id = 1;
        $projectAssign1->status = 1;
        $projectAssign1->save();

        $projectAssign2 = new ProjectAssignment();
        $projectAssign2->user_id = 21;
        $projectAssign2->project_id = 1;
        $projectAssign2->status = 1;
        $projectAssign2->save();

        $projectAssign4 = new ProjectAssignment();
        $projectAssign4->user_id = 7;
        $projectAssign4->project_id = 1;
        $projectAssign4->status = 1;
        $projectAssign4->save();

        $projectAssign5 = new ProjectAssignment();
        $projectAssign5->user_id = 12;
        $projectAssign5->project_id = 1;
        $projectAssign5->status = 1;
        $projectAssign5->save();

        $projectAssign3 = new ProjectAssignment();
        $projectAssign3->user_id = 27;
        $projectAssign3->project_id = 1;
        $projectAssign3->status = 1;
        $projectAssign3->save();

        /* Team with project 'SFDC-NGB'. */
        $projectAssign6 = new ProjectAssignment();
        $projectAssign6->user_id = 2;
        $projectAssign6->project_id = 2;
        $projectAssign6->status = 1;
        $projectAssign6->save();

        $projectAssign7 = new ProjectAssignment();
        $projectAssign7->user_id = 11;
        $projectAssign7->project_id = 2;
        $projectAssign7->status = 1;
        $projectAssign7->save();

        $projectAssign8 = new ProjectAssignment();
        $projectAssign8->user_id = 12;
        $projectAssign8->project_id = 2;
        $projectAssign8->status = 1;
        $projectAssign8->save();

        $projectAssign9 = new ProjectAssignment();
        $projectAssign9->user_id = 27;
        $projectAssign9->project_id = 2;
        $projectAssign9->status = 1;
        $projectAssign9->save();

        /* Team with project 'MIETEN-RD'. */
        $projectAssign10 = new ProjectAssignment();
        $projectAssign10->user_id = 4;
        $projectAssign10->project_id = 3;
        $projectAssign10->status = 1;
        $projectAssign10->save();

        $projectAssign11 = new ProjectAssignment();
        $projectAssign11->user_id = 13;
        $projectAssign11->project_id = 3;
        $projectAssign11->status = 1;
        $projectAssign11->save();

        $projectAssign12 = new ProjectAssignment();
        $projectAssign12->user_id = 25;
        $projectAssign12->project_id = 3;
        $projectAssign12->status = 1;
        $projectAssign12->save();

        /* Team with project 'MIETEN-STEP2'. */
        $projectAssign13 = new ProjectAssignment();
        $projectAssign13->user_id = 4;
        $projectAssign13->project_id = 4;
        $projectAssign13->status = 1;
        $projectAssign13->save();

        $projectAssign14 = new ProjectAssignment();
        $projectAssign14->user_id = 13;
        $projectAssign14->project_id = 4;
        $projectAssign14->status = 1;
        $projectAssign14->save();

        $projectAssign15 = new ProjectAssignment();
        $projectAssign15->user_id = 22;
        $projectAssign15->project_id = 4;
        $projectAssign15->status = 1;
        $projectAssign15->save();

        $projectAssign16 = new ProjectAssignment();
        $projectAssign16->user_id = 25;
        $projectAssign16->project_id = 4;
        $projectAssign16->status = 1;
        $projectAssign16->save();

        /* Team with project 'DOCOMO-DATA'. */
        $projectAssign17 = new ProjectAssignment();
        $projectAssign17->user_id = 9;
        $projectAssign17->project_id = 5;
        $projectAssign17->status = 1;
        $projectAssign17->save();

        /* Team with project 'DOCOMO-MESSAGE'. */
        $projectAssign18 = new ProjectAssignment();
        $projectAssign18->user_id = 9;
        $projectAssign18->project_id = 6;
        $projectAssign18->status = 1;
        $projectAssign18->save();

        $projectAssign19 = new ProjectAssignment();
        $projectAssign19->user_id = 13;
        $projectAssign19->project_id = 6;
        $projectAssign19->status = 1;
        $projectAssign19->save();

        /* Team with project 'FSVM'. */
        $projectAssign20 = new ProjectAssignment();
        $projectAssign20->user_id = 3;
        $projectAssign20->project_id = 7;
        $projectAssign20->status = 1;
        $projectAssign20->save();

        $projectAssign21 = new ProjectAssignment();
        $projectAssign21->user_id = 8;
        $projectAssign21->project_id = 7;
        $projectAssign21->status = 1;
        $projectAssign21->save();

        $projectAssign22 = new ProjectAssignment();
        $projectAssign22->user_id = 15;
        $projectAssign22->project_id = 7;
        $projectAssign22->status = 1;
        $projectAssign22->save();

        $projectAssign23 = new ProjectAssignment();
        $projectAssign23->user_id = 18;
        $projectAssign23->project_id = 7;
        $projectAssign23->status = 1;
        $projectAssign23->save();

        $projectAssign24 = new ProjectAssignment();
        $projectAssign24->user_id = 23;
        $projectAssign24->project_id = 7;
        $projectAssign24->status = 1;
        $projectAssign24->save();

        $projectAssign25 = new ProjectAssignment();
        $projectAssign25->user_id = 26;
        $projectAssign25->project_id = 7;
        $projectAssign25->status = 1;
        $projectAssign25->save();

        /* Team with project 'VAC'. */
        $projectAssign26 = new ProjectAssignment();
        $projectAssign26->user_id = 9;
        $projectAssign26->project_id = 8;
        $projectAssign26->status = 1;
        $projectAssign26->save();

        /* Team with project 'CIMA'. */
        $projectAssign27 = new ProjectAssignment();
        $projectAssign27->user_id = 4;
        $projectAssign27->project_id = 9;
        $projectAssign27->status = 1;
        $projectAssign27->save();

        $projectAssign28 = new ProjectAssignment();
        $projectAssign28->user_id = 17;
        $projectAssign28->project_id = 9;
        $projectAssign28->status = 1;
        $projectAssign28->save();

        $projectAssign29 = new ProjectAssignment();
        $projectAssign29->user_id = 19;
        $projectAssign29->project_id = 9;
        $projectAssign29->status = 1;
        $projectAssign29->save();

        $projectAssign30 = new ProjectAssignment();
        $projectAssign30->user_id = 20;
        $projectAssign30->project_id = 9;
        $projectAssign30->status = 1;
        $projectAssign30->save();

        $projectAssign31 = new ProjectAssignment();
        $projectAssign31->user_id = 25;
        $projectAssign31->project_id = 9;
        $projectAssign31->status = 1;
        $projectAssign31->save();

        /* Team with project 'KOKEN'. */
        $projectAssign32 = new ProjectAssignment();
        $projectAssign32->user_id = 16;
        $projectAssign32->project_id = 10;
        $projectAssign32->status = 1;
        $projectAssign32->save();

        /* Team with project 'BIP internal'. */
        $projectAssign33 = new ProjectAssignment();
        $projectAssign33->user_id = 8;
        $projectAssign33->project_id = 11;
        $projectAssign33->status = 1;
        $projectAssign33->save();

        $projectAssign34 = new ProjectAssignment();
        $projectAssign34->user_id = 14;
        $projectAssign34->project_id = 11;
        $projectAssign34->status = 1;
        $projectAssign34->save();

        /* Team with project 'RSS'. */
        $projectAssign35 = new ProjectAssignment();
        $projectAssign35->user_id = 10;
        $projectAssign35->project_id = 12;
        $projectAssign35->status = 1;
        $projectAssign35->save();

        $projectAssign36 = new ProjectAssignment();
        $projectAssign36->user_id = 22;
        $projectAssign36->project_id = 12;
        $projectAssign36->status = 1;
        $projectAssign36->save();

        $projectAssign37 = new ProjectAssignment();
        $projectAssign37->user_id = 26;
        $projectAssign37->project_id = 12;
        $projectAssign37->status = 1;
        $projectAssign37->save();
    }
}
