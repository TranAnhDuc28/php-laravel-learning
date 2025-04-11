<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use App\Models\SkillItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        return view('skill.item.index', [
            'skill_items' => $skill_items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('skill.item.create', [
            'skill_categories' => $skill_categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function processCreate(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|integer|exists:skill_category,id',
            'name' => 'required|unique:skill_item|max:255',
            'display_order' => 'required|integer|min:-1000|max:1000',
            'description' => 'nullable|string|max:500',
        ]);

        $skill_item = new SkillItem();
        $skill_item->category_id = $validated['category'];
        $skill_item->name = $validated['name'];
        $skill_item->display_order = (int)$validated['display_order'];
        $skill_item->description = $validated['description'];
        $skill_item->save();

        return redirect(route('skill-item.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $skill_item = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_item = SkillItem::find($id);
        }
        if ($skill_item == null) {
            return redirect(route('skill-item.index'));
        }

        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('skill.item.update', [
            'skill_categories' => $skill_categories,
            'skill_item' => $skill_item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function processUpdate(Request $request, $id)
    {
        $skill_item = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_item = SkillItem::find($id);
        }
        if ($skill_item == null) {
            return redirect(route('skill-item.index'));
        }

        $validated = $request->validate([
            'category' => 'required|integer|exists:skill_category,id',
            'name' => [
                'required',
                'max:255',
                Rule::unique(SkillItem::class)->ignore($skill_item->id),
            ],
            'display_order' => 'required|integer|min:-1000|max:1000',
            'description' => 'nullable|string|max:500',
        ]);

        $skill_item->category_id = $validated['category'];
        $skill_item->name = $validated['name'];
        $skill_item->display_order = (int)$validated['display_order'];
        $skill_item->description = $validated['description'];
        $skill_item->save();

        return redirect(route('skill-item.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function processDelete(Request $request, $id)
    {
        $skill_item = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_item = SkillItem::find($id);
        }
        if ($skill_item == null) {
            return redirect(route('skill-item.index'));
        }

        $skill_item->delete();
        return redirect()->route('skill-item.index');
    }
}
