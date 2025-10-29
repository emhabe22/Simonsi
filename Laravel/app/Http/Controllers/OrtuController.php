<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrtuController extends Controller
{
    public function dashboard()
    {
       
        return view('ortu.dashboard');
    }
        public function absensi()
    {
        return view('ortu.absensi');
    }

    public function nilai()
    {
        return view('ortu.nilai');
    }
            public function laporan()
    {
        return view('ortu.laporan');
    }
}
