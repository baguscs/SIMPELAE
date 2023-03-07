<?php

namespace App\Http\Controllers;

use App\Models\Aparat;
use App\Models\Warga;
use App\Models\Jabatan;
use App\Models\Wilayah_rt;
use Illuminate\Http\Request;

class AparatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titlePage = "Data Aparat";
        $data = Aparat::all();
        return view('template.aparat.index', compact('titlePage', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titlePage = "Tambah Aparat";
        $warga = Warga::where('aparat', 0)->get();
        $jabatan = Jabatan::where('id', '!=', 3)->get();
        $region = Wilayah_rt::all();
        return view('template.aparat.add', compact('titlePage', 'warga', 'jabatan', 'region'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wargas_id' => 'required|unique:aparats',
            'jabatans_id' => 'required',
            'wilayah_rts_id' => 'unique:aparats',
        ]);

        if ($request->jabatans_id == 1) {
            $checkJabatan = Aparat::where('jabatans_id', 1)->count();
            if ($checkJabatan > 0) {
                return redirect()->back()->with("error", "Jabatan sudah terisi");
            }
        }

        Aparat::create($request->all());

        $updateWarga = Warga::find($request->wargas_id);

        $updateWarga->aparat = 1;

        $updateWarga->save();

        return redirect()->route('aparat.index')->with("message", "Berhasil Menambah Aparat");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
