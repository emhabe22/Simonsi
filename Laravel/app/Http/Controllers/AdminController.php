<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Ortu;
use App\Models\Guru;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /* ===============================
       DASHBOARD & HALAMAN UTAMA
    =============================== */
    public function dashboard()
    {
        // Hitung total data dari database
        $totalGuru = Guru::count();
        $totalOrangTua = Ortu::count();
        $totalSiswa = Siswa::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalGuru', 'totalOrangTua', 'totalSiswa'));
    }

    public function absensi(Request $request)
    {
        // Ambil semua kelas untuk dropdown
        $kelas = Kelas::all();

        // Jika ada kelas yang dipilih, ambil siswanya
        $siswa = [];
        $tanggal = $request->tanggal ?? date('Y-m-d');

        if ($request->kelas_id) {
            $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();

            // Load data absensi yang sudah ada untuk tanggal ini
            $absensiData = Absensi::where('date', $tanggal)
                ->whereIn('siswa_id', $siswa->pluck('id'))
                ->get()
                ->keyBy('siswa_id');

            // Tambahkan data absensi ke setiap siswa
            foreach ($siswa as $s) {
                $s->absensi_status = $absensiData->get($s->id)?->status ?? null;
            }
        }

        return view('admin.absensi', compact('kelas', 'siswa', 'tanggal'));
    }

    /**
     * Simpan absensi siswa - DIPERBARUI
     */
    public function simpan_absensi(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
        ]);

        // Ambil guru login (fallback ID 1 jika tidak ada)
        $guruId = Auth::user()->guru->id ?? 1;
        $tanggal = $request->tanggal;

        // Ambil semua siswa di kelas tersebut
        $siswaIds = Siswa::where('kelas_id', $request->kelas_id)->pluck('id');

        foreach ($siswaIds as $siswaId) {
            // Cek apakah siswa ini dicentang
            $isChecked = isset($request->siswa[$siswaId]['checked']);

            if ($isChecked) {
                // Jika dicentang, ambil status yang dipilih
                $statusInput = $request->siswa[$siswaId]['status'] ?? 'hadir';
                $status = match ($statusInput) {
                    'hadir' => 'present',
                    'sakit' => 'sick',
                    'izin'  => 'permission',
                    'alpa'  => 'absent',
                    default => 'present'
                };
            } else {
                // Jika tidak dicentang, otomatis alpa
                $status = 'absent';
            }

            // Simpan atau update absensi
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'date' => $tanggal
                ],
                [
                    'status' => $status,
                    'guru_id' => $guruId
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
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
        $guruList = Guru::with(['kelas', 'mapel'])->get();
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
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();
        return view('admin.tambah_guru', compact('kelasList', 'mapelList'));
    }

    public function tambah_orangtua()
    {
        $siswaList = Siswa::all();
        return view('admin.tambah_orangtua', compact('siswaList'));
    }

    public function tambah_siswa()
    {
        $kelasList = Kelas::all();
        return view('admin.tambah_siswa', compact('kelasList'));
    }

    public function tambah_kelas()
    {
        return view('admin.tambah_kelas');
    }

    public function tambah_mapel()
    {
        $kelasList = Kelas::all();
        return view('admin.tambah_mapel', compact('kelasList'));
    }

    public function tambah_akademik()
    {
        return view('admin.tambah_akademik');
    }

    /* ===============================
       SIMPAN DATA
    =============================== */
    public function simpan_guru(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:gurus,nip',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
        ]);

        Guru::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'user_id' => \App\Models\User::first()?->id ?? 1,
        ]);

        return redirect()->route('admin.data_guru')->with('success', 'Data guru berhasil ditambahkan!');
    }

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

        return redirect()->route('admin.data_siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function simpan_orangtua(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:ortus,phone',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        Ortu::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'siswa_id' => $request->siswa_id,
            'user_id' => \App\Models\User::first()?->id ?? 5,
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
            return redirect()->route('admin.data_orangtua')->with('error', 'Data orang tua tidak ditemukan.');
        }

        $ortu->delete();

        return redirect()->route('admin.data_orangtua')->with('success', 'Data orang tua berhasil dihapus!');
    }

    // ===== Siswa =====
    public function edit_siswa($id)
    {
        $siswa = Siswa::with('kelas')->find($id);
        $kelasList = Kelas::all();

        if (!$siswa) {
            return redirect()->route('admin.data_siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.edit_siswa', compact('siswa', 'kelasList'));
    }

    public function update_siswa(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:siswas,nisn,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        $siswa = Siswa::find($id);

        if (!$siswa) {
            return redirect()->route('admin.data_siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

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
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return redirect()->route('admin.data_siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()->route('admin.data_siswa')->with('success', 'Data siswa berhasil dihapus!');
    }

    // ===== Guru =====
    public function edit_guru($id)
    {
        $guru = Guru::find($id);
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();

        if (!$guru) {
            return redirect()->route('admin.data_guru')->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin.edit_guru', compact('guru', 'kelasList', 'mapelList'));
    }

    public function update_guru(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:gurus,nip,' . $id,
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
        ]);

        $guru = Guru::find($id);

        if (!$guru) {
            return redirect()->route('admin.data_guru')->with('error', 'Data guru tidak ditemukan.');
        }

        $guru->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
        ]);

        return redirect()->route('admin.data_guru')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function hapus_guru($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return redirect()->route('admin.data_guru')->with('error', 'Data guru tidak ditemukan.');
        }

        $guru->delete();

        return redirect()->route('admin.data_guru')->with('success', 'Data guru berhasil dihapus!');
    }

    // ===== Orang Tua =====
    public function edit_orangtua($id)
    {
        $orangtua = Ortu::with('siswa')->find($id);
        $siswaList = Siswa::all();

        if (!$orangtua) {
            return redirect()->route('admin.data_orangtua')->with('error', 'Data orang tua tidak ditemukan.');
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
            return redirect()->route('admin.data_orangtua')->with('error', 'Data orang tua tidak ditemukan.');
        }

        $orangtua->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'siswa_id' => $request->siswa_id,
        ]);

        return redirect()->route('admin.data_orangtua')->with('success', 'Data orang tua berhasil diperbarui!');
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

        return redirect()->route('admin.data_kelas')->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function hapus_kelas($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();

        if (!$kelas) {
            return redirect()->route('admin.data_kelas')->with('error', 'Data kelas tidak ditemukan.');
        }

        DB::table('kelas')->where('id', $id)->delete();

        return redirect()->route('admin.data_kelas')->with('success', 'Data kelas berhasil dihapus!');
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

        return redirect()->route('admin.data_mapel')->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    public function edit_mapel($id)
    {
        $mapel = Mapel::find($id);
        $kelasList = Kelas::all();

        if (!$mapel) {
            return redirect()->route('admin.data_mapel')->with('error', 'Data mata pelajaran tidak ditemukan.');
        }

        return view('admin.edit_mapel', compact('mapel', 'kelasList'));
    }

    public function update_mapel(Request $request, $id)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mapel = Mapel::find($id);

        if (!$mapel) {
            return redirect()->route('admin.data_mapel')->with('error', 'Data mata pelajaran tidak ditemukan.');
        }

        $mapel->update([
            'name' => $request->mapel,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.data_mapel')->with('success', 'Data mata pelajaran berhasil diperbarui!');
    }

    public function hapus_mapel($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return redirect()->route('admin.data_mapel')->with('error', 'Data mata pelajaran tidak ditemukan.');
        }

        $mapel->delete();

        return redirect()->route('admin.data_mapel')->with('success', 'Data mata pelajaran berhasil dihapus!');
    }
}
