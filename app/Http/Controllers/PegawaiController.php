<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Cuti;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
 
class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::all();
        
        $filterNip = $request->input('nip');
        $filterName = $request->input('employeeName');

        $filter = $request->input('filterInput');
        $pegawai = Pegawai::when($filterNip, function ($query) use ($filterNip) {
            return $query->where('nip', 'like', '%' . $filterNip . '%');
        })
        ->when($filterName, function ($query) use ($filterName) {
            return $query->where('employee_name', 'like', '%' . $filterName . '%');
        })
        ->get();

        return view('index', compact('pegawai'));
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_employee');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'nip' => 'required',
            'address' => 'required',
        ]);

        $jumlahData = Pegawai::count();

       
        $pegawai = new Pegawai($request->all());
        
        if ($jumlahData == 0) {
            $pegawai->nip = 1111;
        } else {
            $nomorNIPTerakhir = (int) Pegawai::orderBy('nip', 'desc')->first()->nip;
            $nomorNIPBaru = str_pad($nomorNIPTerakhir + 1, 4, 0, STR_PAD_LEFT);
            $pegawai->nip = $nomorNIPBaru;
        }

        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function destroy(id $id)
    {
        $pegawai = Pegawai::find($id);
    
        // if (!$pegawai) {
        //     return redirect()->route('pegawai.index')->with('error', 'Data tidak ditemukan.');
        // }
    
        $pegawai->delete();
    
        // return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus.');
    }
}
