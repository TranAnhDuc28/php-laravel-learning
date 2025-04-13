<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class BlogController extends PageController
{
    /**
     * @return Factory|View|Application|object
     */
    public function showBlogListView() {
        return view('pages.blog.list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBlogGridView() {
        return view('pages.blog.grid');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBlogOverView() {
        return view('pages.blog.overview');
    }
}
