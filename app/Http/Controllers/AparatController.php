<?php

namespace App\Http\Controllers;

use App\Models\Aparat;
use App\Models\Warga;
use App\Models\Jabatan;
use App\Models\Wilayah_rt;
use App\Models\User;
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

        $checkAccount = User::where('wargas_id', $request->wargas_id)->count();

        if ($checkAccount > 0) {
            if ($request->jabatans_id == 1) {
                $checkJabatan = Aparat::where('jabatans_id', 1)->count();
                if ($checkJabatan > 0) {
                    return redirect()->back()->with("error", "Jabatan sudah terisi");
                }
            }

            $execute = Aparat::create($request->all());

            $updateWarga = Warga::find($request->wargas_id);

            $updateWarga->aparat = 1;
            $updateWarga->save();

            $updateAkun = User::where('wargas_id', $request->wargas_id)->firstOrFail();

            $updateAkun->aparats_id = $execute->id;
            $updateAkun->jabatans_id = $request->jabatans_id;
            $updateAkun->save();


            return redirect()->route('aparat.index')->with("message", "Berhasil Menambah Aparat");
        }
        else{
            return redirect()->back()->with("error", "Akun Belum Terdaftar");
        }
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
    public function edit(Aparat $aparat)
    {
        $titlePage = "Edit Aparat";
        $warga = Warga::all();
        $jabatan = Jabatan::where('id', '!=', 3)->get();
        $region = Wilayah_rt::all();
        return view('template.aparat.edit', compact('titlePage', 'warga', 'jabatan', 'region', 'aparat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aparat $aparat)
    {
        $request->validate([
            'jabatans_id' => 'required',
        ]);

        if ($request->wargas_id != $aparat->wargas_id) {
            $request->validate([
                'wargas_id' => 'required|unique:aparats',
            ]);
        }
        elseif ($request->wilayah_rts_id != $aparat->wilayah_rts_id) {
            $request->validate([
                'wilayah_rts_id' => 'unique:aparats',
            ]);
        }
        elseif ($request->jabatans_id == 1) {
            $checkJabatan = Aparat::where('jabatans_id', 1)->count();
            if ($checkJabatan > 0) {
                return redirect()->back()->with("error", "Jabatan sudah terisi");
            }
        }

        $getNameWarga = Warga::find($request->wargas_id);

        $aparat->update($request->all());

        $updateAccount = User::where('wargas_id', $request->wargas_id)->firstOrFail();
        $updateAccount->jabatans_id = $request->jabatans_id;
        $updateAccount->save();

        return redirect()->route('aparat.index')->with("message", "Berhasil Mengupdate Aparat ". $getNameWarga->nama_warga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aparat $aparat)
    {
        $updateUser = User::where('wargas_id', $aparat->wargas_id)->firstOrFail();
        $updateUser->jabatans_id = 3;
        $updateUser->aparats_id = null;
        $updateUser->save();

        $updateStatusAparat = Warga::find($aparat->wargas_id);

        $updateStatusAparat->aparat = 0;
        $updateStatusAparat->save();

        $getNameWarga = $updateStatusAparat->nama_warga;

        

        $aparat->delete();
        return redirect()->back()->with("message", "Berhasil Menghapus Aparat ". $getNameWarga);
    }
}
