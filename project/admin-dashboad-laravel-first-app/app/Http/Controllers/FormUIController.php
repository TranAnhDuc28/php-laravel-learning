<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class FormUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showBasicElements()
    {
        return view('forms.basic_elements');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFormSelect()
    {
        return view('forms.form_select');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCheckboxsAndRadios()
    {
        return view('forms.checkboxs_radios');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPickers()
    {
        return view('forms.pickers');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showInputMasks()
    {
        return view('forms.input_masks');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFormAdvance()
    {
        return view('forms.form_advance');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRangeSlider()
    {
        return view('forms.range_slider');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFromValidation()
    {
        return view('forms.validation');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showWizards()
    {
        return view('forms.wizard');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showEditors()
    {
        return view('forms.editors');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFileUpload()
    {
        return view('forms.file_upload');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFormLayouts()
    {
        return view('forms.form_layouts');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSelect2()
    {
        return view('forms.select2');
    }
}
