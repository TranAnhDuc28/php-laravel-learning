<?php

class DashboardController
{
    public function index()
    {
        $view = 'dashboard';

        $title = 'Dashboard';

        require_once PATH_VIEW_ADMIN_MAIN;
    }
}