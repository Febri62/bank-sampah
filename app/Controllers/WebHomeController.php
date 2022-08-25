<?php

namespace App\Controllers;

class WebHomeController extends BaseController
{
    public function indexadmin()
    {
        return view('home/view_home_administrator');
    }

    public function indexmitra()
    {
        return view('home/view_home_mitra');
    }
}
