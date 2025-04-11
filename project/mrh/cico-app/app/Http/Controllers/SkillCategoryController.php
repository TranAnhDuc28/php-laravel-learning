<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skill_categories = SkillCategory::orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('skill.category.index', [
            'skill_categories' => $skill_categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skill.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function processCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:skill_category|max:255',
            'display_order' => 'required|integer|min:-1000|max:1000',
            'description' => 'nullable|string|max:500',
        ]);

        $skill_category = new SkillCategory();
        $skill_category->name = $validated['name'];
        $skill_category->display_order = (int)$validated['display_order'];
        $skill_category->description = $validated['description'];
        $skill_category->save();

        return redirect(route('skill-category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $skill_category = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_category = SkillCategory::find($id);
        }
        if ($skill_category == null) {
            return redirect(route('skill-category.index'));
        }

        return view('skill.category.update', [
            'skill_category' => $skill_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function processUpdate(Request $request, $id)
    {
        $skill_category = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_category = SkillCategory::find($id);
        }
        if ($skill_category == null) {
            return redirect(route('skill-category.index'));
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(SkillCategory::class)->ignore($skill_category->id),
            ],
            'display_order' => 'required|integer|min:-1000|max:1000',
            'description' => 'nullable|string|max:500',
        ]);
        $skill_category->name = $validated['name'];
        $skill_category->display_order = (int)$validated['display_order'];
        $skill_category->description = $validated['description'];
        $skill_category->save();

        return redirect(route('skill-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function processDelete(Request $request, $id)
    {
        $skill_category = null;
        if (is_numeric($id) && $id == (int)$id) {
            $skill_category = SkillCategory::find($id);
        }
        if ($skill_category == null) {
            return redirect(route('skill-category.index'));
        }

        $skill_category->delete();
        return redirect()->route('skill-category.index');
    }
}
