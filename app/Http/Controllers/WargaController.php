<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Wilayah_rt;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titlePage = "Data Warga";
        $data = Warga::all();
        $region = Wilayah_rt::all();
        return view('template.warga.index', compact('titlePage', 'data', 'region'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titlePage = "Tambah Warga";
        $region = Wilayah_rt::all();
        return view('template.warga.add', compact('titlePage', 'region'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wilayah_rts_id' => 'required',
            'nik' => 'required|min:16|max:16|unique:wargas',
            'no_kk' => 'required|min:16|max:16|unique:wargas',
            'nama_warga' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
            'no_telp' => 'required',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with("message", "Berhasil Menambah Data Warga ". $request->nama_warga);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        $getData = Warga::find($warga->id);

        $request->validate([
            'wilayah_rts_id' => 'required',
            'nama_warga' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
            'no_telp' => 'required',
        ]);

        if ($getData->nik != $request->nik) {
            $request->validate([
                'nik' => 'required|min:16|max:16|unique:wargas',
            ]);
        }

        if ($getData->no_kk != $request->no_kk) {
            $request->validate([
                'no_kk' => 'required|min:16|max:16|unique:wargas',
            ]);
        }
        
        $warga->update($request->all());
        return redirect()->back()->with("message", "Berhasil Mengupdate Data Warga". $warga->nama_warga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $nama_warga = $warga->nama_warga;

        $warga->delete();
        return redirect()->back()->with("message", "Berhasil Menghapus Data Warga ". $nama_warga);
    }
}
