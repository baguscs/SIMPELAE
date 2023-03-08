<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Wilayah_rt;
use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titlePage = "Data Akun Warga";
        $data = User::all();
        $region = Wilayah_rt::all();
        return view('template.akun.index', compact('titlePage', 'data', 'region'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titlePage = "Tambah Akun Warga";
        $warga = Warga::where('status_akun', '0')->get();
        return view('template.akun.add', compact('titlePage', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
