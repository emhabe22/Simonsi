<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
        public function dashboard()
    {
       
        return view('guru.dashboard');
    }
        public function absensi()
    {
        return view('guru.absensi');
    }

    public function nilai()
    {
        return view('guru.nilai');
    }
        public function cek_nilai()
    {
        return view('guru.cek_nilai');
    }
        public function input_nilai()
    {
        return view('guru.input_nilai');
    }
            public function laporan()
    {
        return view('guru.laporan');
    }
}
