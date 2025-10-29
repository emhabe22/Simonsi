<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function absensi()
    {
        return view('admin.absensi');
    }

    public function nilai()
    {
        return view('admin.nilai');
    }

    public function cek_nilai()
    {
        return view('admin.cek_nilai');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }

    public function data_guru()
    {
        $guruList = collect([
            (object) [
                'nama' => 'Andi Pratama',
                'mapel' => 'Matematika',
                'nip' => '19850304 202001 1 001',
                'kelas' => 'VII A',
            ],
            (object) [
                'nama' => 'Siti Nurhaliza',
                'mapel' => 'Bahasa Indonesia',
                'nip' => '19860915 201903 1 002',
                'kelas' => 'VIII B',
            ],
            (object) [
                'nama' => 'Rizky Hidayat',
                'mapel' => 'IPA',
                'nip' => '19900220 202101 1 003',
                'kelas' => 'IX C',
            ],
        ]);

        return view('admin.data_guru', compact('guruList'));
    }

    public function data_orangtua()
    {
        $ortuList = collect([
            (object) [
                'nama' => 'Andi Pratama',
                'telp' => '081237080604',
                'alamat' => 'Sukun',
                'jk' => 'Laki-laki',
                'namaanak' => 'Budi Pratama',
            ],
            (object) [
                'nama' => 'Siti Nurhaliza',
                'telp' => '081237080605',
                'alamat' => 'Sukun',
                'jk' => 'Perempuan',
                'namaanak' => 'Siti Pratama',
            ],
        ]);

        return view('admin.data_orangtua', compact('ortuList'));
    }

    public function data_siswa()
    {
        $siswaList = collect([
            (object) [
                'nama' => 'Andi Pratama',
                'nis' => '12345',
                'kelas' => 'VII A',
                'alamat' => 'Sukun',
                'tgl_lahir' => '2009-05-12',
                'jk' => 'Laki-laki',
            ],
            (object) [
                'nama' => 'Siti Nurhaliza',
                'nis' => '12346',
                'kelas' => 'VIII B',
                'alamat' => 'Sukun',
                'tgl_lahir' => '2008-08-20',
                'jk' => 'Perempuan',
            ],
        ]);

        return view('admin.data_siswa', compact('siswaList'));
    }

    public function data_kelas()
    {
        $kelasList = collect([
            (object) [
                'kelas' => '3',
                'subclass' => 'B',
            ],
            (object) [
                'kelas' => '4',
                'subclass' => 'C',
            ],
        ]);

        return view('admin.data_kelas', compact('kelasList'));
    }

    public function data_mapel()
    {
        $mapelList = collect([
            (object) [
                'mapel' => 'Matematika',
                'jenjang' => 'Kelas 3',
            ],
            (object) [
                'mapel' => 'Bahasa Indonesia',
                'jenjang' => 'Kelas 6',
            ],
        ]);

        return view('admin.data_mapel', compact('mapelList'));
    }

    public function data_akademik()
    {
        $tahunList = collect([
            (object) [
                'tahun' => '2025/2026',
            ],
            (object) [
                'tahun' => '2024/2025',
            ],
        ]);

        return view('admin.data_akademik', compact('tahunList'));
    }

    public function tambah_guru()
    {
        return view('admin.tambah_guru');
    }

    public function tambah_orangtua()
    {
        return view('admin.tambah_orangtua');
    }

    public function tambah_siswa()
    {
        return view('admin.tambah_siswa');
    }

    public function tambah_kelas()
    {
        return view('admin.tambah_kelas');
    }

    public function tambah_mapel()
    {
        return view('admin.tambah_mapel');
    }

    public function tambah_akademik()
    {
        return view('admin.tambah_akademik');
    }
}
