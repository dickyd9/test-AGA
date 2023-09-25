<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Cuti;

class CutiPegawai extends Controller
{
    //
    public function index(Request $request)
    {
        // Mengambil semua data pegawai
        $pegawai = Pegawai::all();

        // Menyiapkan daftar cuti untuk setiap pegawai
        // $cutiPerPegawai = [];
        // $cutiPerPegawai = Pegawai::with('cuti')->get();
        $cutiPerPegawai = Pegawai::join('cuti', 'pegawai.id', '=', 'cuti.id_employee')
        ->select('pegawai.employee_name', 'cuti.cuti_date', 'cuti.lama_cuti', 'cuti.keterangan')
        ->get();
        // Mengambil data cuti untuk setiap pegawai
        // foreach ($pegawai as $p) {
        //     $cutiPerPegawai[$p->id] = $p->cuti;
        // }

        return view('cuti', compact('pegawai', 'cutiPerPegawai'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_employee' => 'required',
            'cuti_date' => 'required',
            'lama_cuti' => 'required',
            'keterangan' => 'required',
        ]);
       
        $cuti = new Cuti($request->all());
        $cuti->save();

        return redirect()->route('cuti.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function create()
    {
        return view('cuti.create');
    }

    public function destroy($id)
    {
        $cuti = Cuti::find($id);

        if (!$cuti) {
            return redirect()->route('cuti.index')->with('error', 'Data tidak ditemukan.');
        }

        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Data berhasil dihapus.');
    }
}
