<?php

namespace admin;
class HomeController
{
    public function index()
    {
        require_once PATH_VIEW_ADMIN . 'dashboard.php';
    }
}