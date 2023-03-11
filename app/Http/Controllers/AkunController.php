<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Wilayah_rt;
use App\Models\User;
use App\Models\Jabatan;
use App\Mail\RegisterAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $jabatan = Jabatan::all();
        return view('template.akun.index', compact('titlePage', 'data', 'region', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titlePage = "Tambah Akun Warga";
        $warga = Warga::where('status_akun', '0')->get();
        $jabatan = Jabatan::all();
        return view('template.akun.add', compact('titlePage', 'warga', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wargas_id' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
        ]);

        $passwordAccount = Str::random(5);

        $newAccount = new User;

        $newAccount->wargas_id = $request->wargas_id;
        $newAccount->jabatans_id = 3;
        $newAccount->email = $request->email;
        $newAccount->password = Hash::make($passwordAccount);

        $newAccount->save();

        $updateWarga = Warga::find($request->wargas_id);

        $updateWarga->status_akun = "1";
        $updateWarga->save();

        // prepare data
        $mailData = [
            'name' => $updateWarga->nama_warga,
            'email' => $request->email,
            'password' => $passwordAccount
        ];

        // send email
        Mail::to($request->email)->send(new RegisterAccount($mailData));

        // // check status send
        // if (Mail::failures()) {
        //     return redirect()->back()->with('error', 'E-Mail anda tidak terdaftar di Google');
        // }


        return redirect()->route('akun.index')->with("message", "Berhasil Menambah Akun User");
        
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'jabatans_id' => 'required',
        ]);

        if ($request->jabatans_id == 1) {
            $checkAuthor = User::where('jabatans_id', 1)->count();
            if ($checkAuthor > 0) {
                return redirect()->back()->with("error", "Jabatan Sudah terisi");
            }
        }

        $updateAuthor = User::find($request->id);

        $updateAuthor->jabatans_id = $request->jabatans_id;
        $updateAuthor->save();

        return redirect()->back()->with("message", "Berhasil Mengupdate Akun ". $request->nama_warga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $getData = User::find($id);

        $updateStatusAcc = Warga::where('id', $getData->wargas_id)->firstOrFail();
        $updateStatusAcc->status_akun = "0";
        $updateStatusAcc->save();

        $getNameWarga = $updateStatusAcc->nama_warga;

        $getData->delete();
        return redirect()->back()->with("message", "Berhasil Menghapus Akun ". $getNameWarga);
    }
}
