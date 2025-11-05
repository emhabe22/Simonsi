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
        'id' => 1,
        'nama' => 'Andi Pratama',
        'mapel' => 'Matematika',
        'nip' => '19850304 202001 1 001',
        'kelas' => 'VII A',
    ],
    (object) [
        'id' => 2,
        'nama' => 'Siti Nurhaliza',
        'mapel' => 'Bahasa Indonesia',
        'nip' => '19860915 201903 1 002',
        'kelas' => 'VIII B',
    ],
    (object) [
        'id' => 3,
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
                'id' => 1,
                'nama' => 'Andi Pratama',
                'telp' => '081237080604',
                'alamat' => 'Sukun',
                'jk' => 'Laki-laki',
                'namaanak' => 'Budi Pratama',
            ],
            (object) [
                'id' => 2,
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
                'id' => 1,
                'kelas' => '3',
                'subclass' => 'B',
            ],
            (object) [
                'id' => 2,
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
                'id' => 1,
                'mapel' => 'Matematika',
                'jenjang' => 'Kelas 3',
            ],
            (object) [
                'id' => 2,
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
       public function edit_guru($id)
    {
        // Data contoh (seolah-olah dari database)
        $guru = (object)[
            'id' => $id,
            'nama' => 'Budi Santoso',
            'mapel' => 'Matematika',
            'nip' => '123456',
            'kelas' => '7A'
        ];

        return view('admin.edit_guru', compact('guru'));
    }

public function update_guru(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'mapel' => 'required|string|max:255',
        'nip' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
    ]);

    // Contoh dummy (seolah update berhasil)
    $guru = (object)[
        'id' => $id,
        'nama' => $request->nama,
        'mapel' => $request->mapel,
        'nip' => $request->nip,
        'kelas' => $request->kelas,
    ];

    // Redirect ke halaman data guru
    return redirect()->route('admin.data_guru')
                     ->with('success', 'Data guru berhasil diperbarui!');
}
public function edit_orangtua($id)
{
    // Data contoh (seolah dari database)
    $orangtua = (object)[
        'id' => $id,
        'nama' => 'Ahmad Fadli',
        'telp' => '081234567890',
        'alamat' => 'Jl. Merdeka No. 10',
        'jk' => 'Laki-laki',
        'namaanak' => 'Rina Fadilah',
    ];

    return view('admin.edit_orangtua', compact('orangtua'));
}

public function update_orangtua(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'telp' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'jk' => 'required|string',
        'namaanak' => 'required|string|max:255',
    ]);

    // Dummy update (anggap berhasil)
    $orangtua = (object)[
        'id' => $id,
        'nama' => $request->nama,
        'telp' => $request->telp,
        'alamat' => $request->alamat,
        'jk' => $request->jk,
        'namaanak' => $request->namaanak,
    ];

    // Redirect kembali ke halaman data orang tua
    return redirect()->route('admin.data_orangtua')
                     ->with('success', 'Data orang tua berhasil diperbarui!');
}
    public function edit_kelas($id)
    {
        // Data contoh seolah-olah dari database
        $kelas = (object)[
            'id' => $id,
            'kelas' => 'Kelas 3',
            'tipe' => ['A', 'B'], // tipe disimpan sebagai array
        ];

        return view('admin.edit_kelas', compact('kelas'));
    }

    public function update_kelas(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required|string',
            'tipe' => 'required|array|min:1',
        ]);

        // Anggap update berhasil
        $kelas = (object)[
            'id' => $id,
            'kelas' => $request->kelas,
            'tipe' => $request->tipe,
        ];

        return redirect()->route('admin.data_kelas')
                         ->with('success', 'Data kelas berhasil diperbarui!');
    }
    public function edit_mapel($id)
{
    // Data dummy seolah-olah dari database
    $mapel = (object)[
        'id' => $id,
        'mapel' => 'Matematika',
        'kelas' => 'Kelas 3',
    ];

    return view('admin.edit_mapel', compact('mapel'));
}

public function update_mapel(Request $request, $id)
{
    $request->validate([
        'mapel' => 'required|string|max:255',
        'kelas' => 'required|string|max:255',
    ]);

    // Dummy update (anggap data berhasil diupdate)
    $mapel = (object)[
        'id' => $id,
        'mapel' => $request->mapel,
        'kelas' => $request->kelas,
    ];

    return redirect()->route('admin.data_mapel')
                     ->with('success', 'Data mata pelajaran berhasil diperbarui!');
}

}
