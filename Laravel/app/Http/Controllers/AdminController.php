<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Ortu;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /* ===============================
       DASHBOARD & HALAMAN UTAMA
    =============================== */
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

    /* ===============================
       DATA MASTER
    =============================== */

    // ===== Data Guru =====
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

    // ===== Data Orang Tua =====
    public function data_orangtua()
    {
    $ortuList = Ortu::with('siswa')->get();

    return view('admin.data_orangtua', compact('ortuList'));
    }

    // ===== Data Siswa =====
    public function data_siswa()
    {
       $siswaList = Siswa::with('kelas')->get();

        return view('admin.data_siswa', compact('siswaList'));
    }

    // ===== Data Kelas =====
    public function data_kelas()
    {
        $kelasList = Kelas::all();
        return view('admin.data_kelas', compact('kelasList'));
    }

    // ===== Data Mapel =====
    public function data_mapel()
    {
    $mapelList = Mapel::with('kelas')->get();
    return view('admin.data_mapel', compact('mapelList'));
    }

    // ===== Data Tahun Akademik =====
    public function data_akademik()
    {
        $tahunList = TahunAkademik::all();
        return view('admin.data_akademik', compact('tahunList'));
    }

    /* ===============================
       FORM TAMBAH DATA
    =============================== */
    public function tambah_guru()
    {
        return view('admin.tambah_guru');
    }

public function tambah_orangtua()
{
    $siswaList = Siswa::all();
    return view('admin.tambah_orangtua', compact('siswaList'));
}

    public function tambah_siswa()
    
    {
       $kelasList = Kelas::all(); // Ambil semua data kelas dari database
    return view('admin.tambah_siswa', compact('kelasList'));
    }

    public function tambah_kelas()
    {
        return view('admin.tambah_kelas');
    }

     public function tambah_mapel()
    {
        $kelasList = Kelas::all(); // Ambil semua kelas dari database
        return view('admin.tambah_mapel', compact('kelasList'));
    }

    public function tambah_akademik()
    {
        return view('admin.tambah_akademik');
    }

    /* ===============================
       SIMPAN DATA
    =============================== */
    public function simpan_kelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required|integer',
            'tipe' => 'required|array',
        ]);

        foreach ($request->tipe as $sub) {
            DB::table('kelas')->insert([
                'class' => $request->kelas,
                'subclass' => $sub,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.data_kelas')->with('success', 'Data kelas berhasil disimpan!');
    }

    public function simpan_akademik(Request $request)
    {
        $request->validate([
            'akademik' => 'required|string|max:255',
        ]);

        DB::table('tahun_akademik')->insert([
            'id_tahun' => $request->akademik,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.data_akademik')->with('success', 'Tahun Akademik berhasil ditambahkan!');
    }
    public function simpan_siswa(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nisn' => 'required|string|max:20|unique:siswas,nisn',
        'kelas_id' => 'required|exists:kelas,id',
        'address' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:male,female',
    ]);

    Siswa::create($request->all());

    return redirect()->route('admin.data_siswa')
                     ->with('success', 'Data siswa berhasil ditambahkan!');
}
 public function simpan_orangtua(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:ortus,phone',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        Ortu::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => now(), // jika tidak diinput manual
            'siswa_id' => $request->siswa_id,
            'user_id' => \App\Models\User::first()?->id ?? null, // sementara isi 1 jika belum ada auth
        ]);

        return redirect()->route('admin.data_orangtua')->with('success', 'Data orang tua berhasil disimpan!');
    }

    /* ===============================
       EDIT & UPDATE DATA
    =============================== */

    
    public function hapus_orangtua($id)
{
    $ortu = Ortu::find($id);

    if (!$ortu) {
        return redirect()->route('admin.data_orangtua')
                         ->with('error', 'Data orang tua tidak ditemukan.');
    }

    $ortu->delete();

    return redirect()->route('admin.data_orangtua')
                     ->with('success', 'Data orang tua berhasil dihapus!');
}

    // ===== Siswa =====
public function edit_siswa($id)
{
    // Ambil data siswa berdasarkan ID beserta relasi kelasnya
    $siswa = Siswa::with('kelas')->find($id);
    $kelasList = Kelas::all();

    // Jika siswa tidak ditemukan, arahkan kembali
    if (!$siswa) {
        return redirect()->route('admin.data_siswa')->with('error', 'Data siswa tidak ditemukan.');
    }

    return view('admin.edit_siswa', compact('siswa', 'kelasList'));
}

public function update_siswa(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'nisn' => 'required|string|max:20|unique:siswas,nisn,' . $id,
        'kelas_id' => 'required|exists:kelas,id',
        'address' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:male,female',
    ]);

    // Ambil data siswa
    $siswa = Siswa::find($id);

    if (!$siswa) {
        return redirect()->route('admin.data_siswa')->with('error', 'Data siswa tidak ditemukan.');
    }

    // Update data
    $siswa->update([
        'name' => $request->name,
        'nisn' => $request->nisn,
        'kelas_id' => $request->kelas_id,
        'address' => $request->address,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
    ]);

    return redirect()->route('admin.data_siswa')->with('success', 'Data siswa berhasil diperbarui!');
}
public function hapus_siswa($id)
{
    // Cek apakah data siswa ada
    $siswa = Siswa::find($id);

    if (!$siswa) {
        return redirect()->route('admin.data_siswa')
                         ->with('error', 'Data siswa tidak ditemukan.');
    }

    // Hapus data siswa
    $siswa->delete();

    return redirect()->route('admin.data_siswa')
                     ->with('success', 'Data siswa berhasil dihapus!');
}

    // ===== Guru =====
    public function edit_guru($id)
    {
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'kelas' => 'required|string|max:50',
        ]);

        $guru = (object)[
            'id' => $id,
            'nama' => $request->nama,
            'mapel' => $request->mapel,
            'nip' => $request->nip,
            'kelas' => $request->kelas,
        ];

        return redirect()->route('admin.data_guru')
                         ->with('success', 'Data guru berhasil diperbarui!');
    }

    // ===== Orang Tua =====
  public function edit_orangtua($id)
{
    // Ambil data ortu + relasi siswa
    $orangtua = Ortu::with('siswa')->find($id);
    $siswaList = Siswa::all();

    if (!$orangtua) {
        return redirect()->route('admin.data_orangtua')
                         ->with('error', 'Data orang tua tidak ditemukan.');
    }

    return view('admin.edit_orangtua', compact('orangtua', 'siswaList'));
}

public function update_orangtua(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20|unique:ortus,phone,' . $id,
        'address' => 'required|string|max:255',
        'gender' => 'required|in:male,female',
        'siswa_id' => 'required|exists:siswas,id',
    ]);

    $orangtua = Ortu::find($id);

    if (!$orangtua) {
        return redirect()->route('admin.data_orangtua')
                         ->with('error', 'Data orang tua tidak ditemukan.');
    }

    $orangtua->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
        'siswa_id' => $request->siswa_id,
    ]);

    return redirect()->route('admin.data_orangtua')
                     ->with('success', 'Data orang tua berhasil diperbarui!');
}

    // ===== Kelas =====
public function edit_kelas($id)
{
    $kelas = DB::table('kelas')->where('id', $id)->first();

    if (!$kelas) {
        return redirect()->route('admin.data_kelas')->with('error', 'Data kelas tidak ditemukan.');
    }

    return view('admin.edit_kelas', compact('kelas'));
}

    public function update_kelas(Request $request, $id)
{
    $request->validate([
        'kelas' => 'required|integer',
        'subclass' => 'required|string',
    ]);

    DB::table('kelas')->where('id', $id)->update([
        'class' => $request->kelas,
        'subclass' => $request->subclass,
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.data_kelas')
                     ->with('success', 'Data kelas berhasil diperbarui!');
}

        public function hapus_kelas($id)
    {
        // Cek apakah data ada
        $kelas = DB::table('kelas')->where('id', $id)->first();

        if (!$kelas) {
            return redirect()->route('admin.data_kelas')->with('error', 'Data kelas tidak ditemukan.');
        }

        // Hapus data
        DB::table('kelas')->where('id', $id)->delete();

        return redirect()->route('admin.data_kelas')
                         ->with('success', 'Data kelas berhasil dihapus!');
    }

    // ===== Mapel =====


    public function simpan_mapel(Request $request)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Mapel::create([
            'name' => $request->mapel,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.data_mapel')
                         ->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }
    public function edit_mapel($id)
    {
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

        $mapel = (object)[
            'id' => $id,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
        ];

        return redirect()->route('admin.data_mapel')
                         ->with('success', 'Data mata pelajaran berhasil diperbarui!');
    }
    // ===== Hapus Mapel =====
public function hapus_mapel($id)
{
    // Cek apakah data mapel ada
    $mapel = Mapel::find($id);

    if (!$mapel) {
        return redirect()->route('admin.data_mapel')
                         ->with('error', 'Data mata pelajaran tidak ditemukan.');
    }

    // Hapus data mapel
    $mapel->delete();

    return redirect()->route('admin.data_mapel')
                     ->with('success', 'Data mata pelajaran berhasil dihapus!');
}

}
