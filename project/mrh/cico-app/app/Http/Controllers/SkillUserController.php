<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use App\Models\SkillItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SkillUserController extends Controller
{
    /**
     * Show data List.
     */
    public function index(Request $request)
    {
        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();

        $skill_items = [];
        foreach ($skill_categories as $skill_category) {
            $skill_items_by_category = SkillItem::where('category_id', $skill_category->id)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();
            foreach ($skill_items_by_category as $skill_item) {
                $skill_items[] = $skill_item;
            }
        }

        $skill_data_by_users = [];
        $all_users = User::where([
            ['role', '!=', 0],
            ['role', '!=', 9]
        ])->get();
        foreach ($all_users as $user) {
            $skill_data_by_users[] = [$user->id, $user->name, $user->skill_updated_at, $this->buildSkillItemValuesByUser($skill_items, $user)];
        }

        return view('skill.index', [
            'skill_categories' => $skill_categories,
            'skill_items' => $skill_items,
            'skill_data_by_users' => $skill_data_by_users,
        ]);
    }

    /**
     * Show data of current User.
     */
    public function show(Request $request)
    {
        // Is Power User
//        if (Auth::user()->role == 0 || Auth::user()->role == 9) {
//            return redirect()->route('skill-user.list');
//        }

        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();
        $skill_items = [];
        foreach ($skill_categories as $skill_category) {
            $skill_items_by_category = SkillItem::where('category_id', $skill_category->id)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();
            foreach ($skill_items_by_category as $skill_item) {
                $skill_items[] = $skill_item;
            }
        }

        $user = Auth::user();
        $skill_item_values = $this->buildSkillItemValuesByUser($skill_items, $user);

        return view('skill.show', [
            'user' => $user,
            'skill_categories' => $skill_categories,
            'skill_items' => $skill_items,
            'skill_item_values' => $skill_item_values,
        ]);
    }

    /**
     * Edit form.
     */
    public function edit(Request $request, $user_id = null)
    {
        // Validate role.
        $user = null;
        if ($user_id != null) {
            $current_role = Auth::user()->role;
            if ($current_role != 0 && $current_role != 9) {
                return redirect(route('skill-user.show'));
            } else {
                if (is_numeric($user_id) && $user_id == (int)$user_id) {
                    $user = User::find($user_id);
                }
                if ($user == null) {
                    return redirect(route('skill-user.list'));
                }
            }
        }

        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();
        $skill_items = [];
        foreach ($skill_categories as $skill_category) {
            $skill_items_by_category = SkillItem::where('category_id', $skill_category->id)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();
            foreach ($skill_items_by_category as $skill_item) {
                $skill_items[] = $skill_item;
            }
        }

        $skill_item_values = $this->buildSkillItemValuesByUser($skill_items, $user ?? Auth::user());

        return view('skill.edit', [
            'user' => $user,
            'skill_categories' => $skill_categories,
            'skill_items' => $skill_items,
            'skill_item_values' => $skill_item_values,
        ]);
    }

    /**
     * Process Edit.
     */
    public function processEdit(Request $request, $user_id = null)
    {
        // Validate role.
        $current_role = Auth::user()->role;
        $user = null;
        if ($user_id != null) {
            if ($current_role != 0 && $current_role != 9) {
                return redirect(route('skill-user.show'));
            } else {
                if (is_numeric($user_id) && $user_id == (int)$user_id) {
                    $user = User::find($user_id);
                }
                if ($user == null) {
                    return redirect(route('skill-user.list'));
                }
            }
        }

        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();
        $skill_items = [];
        foreach ($skill_categories as $skill_category) {
            $skill_items_by_category = SkillItem::where('category_id', $skill_category->id)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();
            foreach ($skill_items_by_category as $skill_item) {
                $skill_items[] = $skill_item;
            }
        }

        $rules = [];
        $attributes = [];
        foreach ($skill_items as $skill_item) {
            $field_name = 'item-' . $skill_item->id;
            $rules[$field_name] = ['required', 'integer', 'max:5', 'min:0'];
            $attributes[$field_name] = "[$skill_item->name]";
        }
        $validated = $request->validate(rules: $rules, attributes: $attributes);

        $skill_item_values = [];
        foreach ($skill_items as $skill_item) {
            $field_name = 'item-' . $skill_item->id;
            if ($validated[$field_name] == null) {
                $skill_item_values[$skill_item->id] = null;
            } else {
                $skill_item_values[$skill_item->id] = (int)$validated[$field_name];
            }
        }

        if ($user == null) {
            $user = Auth::user();
        }
        $user->skill = json_encode($skill_item_values);
        $user->skill_updated_at = Carbon::now();
        $user->save();

        if ($current_role != 0 && $current_role != 9) {
            return redirect(route('skill-user.show'));
        } else {
            return redirect(route('skill-user.list'));
        }
    }

    /**
     * Export data.
     */
    public function export(Request $request, $user = null)
    {
        // Not Power User: can access 1 link only.
        if (Auth::user()->role != 0 && Auth::user()->role != 9 && $user != null) {
            return redirect()->route('skill-user.show', ['user' => null]);
        }

        // Is Power User
        if ((Auth::user()->role == 0 || Auth::user()->role == 9) && $user == null) {
            return redirect()->route('skill-user.list');
        }

        $user_model = null;
        $users = null;
        if ($user == null) {
            $user_model = Auth::user();
        } elseif ($user == 'all') {
            $users = User::where([
                ['role', '!=', 0],
                ['role', '!=', 9]
            ])->get();
        } else {
            if (is_numeric($user)) {
                $user_id = (int)$user;
                $user_model = User::find($user_id);
            }

            if ($user_model == null) {
                return redirect()->route('skill-user.list');
            }
        }

        if ($user_model != null) {
            $users = [$user_model];
        }

        /* Prepare data. */
        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();

        $skill_items = [];
        foreach ($skill_categories as $skill_category) {
            $skill_items_by_category = SkillItem::where('category_id', $skill_category->id)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get();
            foreach ($skill_items_by_category as $skill_item) {
                $skill_items[] = $skill_item;
            }
        }

        /* Build sheet. */
        $spreadsheet = new Spreadsheet();
        $active_sheet = $spreadsheet->getActiveSheet();
        $active_sheet->setTitle(config('skill.excel.sheet_name', 'Skill'));

        /* Column A: The name of User. */
        $active_sheet->mergeCells('A1:A2');
        $active_sheet->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $active_sheet->setCellValue('A1', config('skill.excel.header_user', 'User name'));

        if (count($skill_items) > 0) {
            /* Category headers. */
            $current_column_start = 2;
            foreach ($skill_categories as $skill_category) {
                $category_items_count = $skill_category->items->count();
                if ($category_items_count < 1) {
                    continue;
                }

                if ($category_items_count >= 2) {
                    $active_sheet->mergeCells([$current_column_start, 1, $current_column_start + $category_items_count - 1, 1]);
                }

                $active_sheet->setCellValue([$current_column_start, 1], $skill_category->name);
                $active_sheet->getStyle([$current_column_start, 1])
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $current_column_start = $current_column_start + $category_items_count;
            }

            /* Item headers. */
            $current_column_start = 2;
            foreach ($skill_items as $skill_item) {
                $active_sheet->getStyle([$current_column_start, 2])
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setTextRotation(-90)
                    ->setVertical(Alignment::VERTICAL_TOP);
                $active_sheet->setCellValue([$current_column_start, 2], $skill_item->name);
                $current_column_start++;
            }

            $row_start = 3;
            foreach ($users as $user) {
                /* The name of User. */
                $active_sheet->getStyle([1, $row_start])
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $active_sheet->setCellValue([1, $row_start], $user?->name);

                $skill_item_values = $this->buildSkillItemValuesByUser($skill_items, $user);

                /* Item values. */
                $current_column_start = 2;
                foreach ($skill_item_values as $skill_item_value) {
                    $active_sheet->getStyle([$current_column_start, $row_start])
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    $active_sheet->setCellValue([$current_column_start, $row_start], $skill_item_value);

                    $active_sheet
                        ->getStyle([$current_column_start, $row_start])
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB(config('skill.values')[$skill_item_value][0]);

                    $current_column_start++;
                }

                $row_start++;
            }
        }

        $active_sheet->getStyle([1, 1, count($skill_items) + 1, 2])
            ->getFont()
            ->setBold(true);

        $active_sheet->getStyle([1, 1, count($skill_items) + 1, $row_start - 1])
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = 1; $i <= count($skill_items) + 1; $i++) {
            $active_sheet->getColumnDimension(Coordinate::stringFromColumnIndex($i))->setAutoSize(TRUE);
        }

        // Save to Excel file.
        $writer = new Xlsx($spreadsheet);
        if ($user_model != null) {
            $storage_filename = 'skill_' . $user_model->id . '_' . time() . '.xlsx';
            $download_filename = 'skill_' . $user_model->name . '.xlsx';
        } else {
            $storage_filename = 'skill_all_' . time() . '.xlsx';
            $download_filename = 'skill_all.xlsx';
        }

        $writer->save(storage_path('app/' . $storage_filename));

        return response()->download(
            storage_path('app/' . $storage_filename),
            $download_filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment;',
        ])->deleteFileAfterSend(true);
    }

    private function buildSkillItemValuesByUser($skill_items, $user)
    {
        $skill_item_values = [];
        $user_skills = json_decode($user?->skill, true);

        foreach ($skill_items as $skill_item) {
            if ($user_skills && is_array($user_skills) && array_key_exists($skill_item->id, $user_skills)) {
                $skill_item_values[$skill_item->id] = $user_skills[$skill_item->id];
            } else {
                $skill_item_values[$skill_item->id] = 0;
            }
        }

        return $skill_item_values;
    }
}
