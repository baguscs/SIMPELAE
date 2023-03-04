<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $titlePage = "Profil Akun";
        $linkActived = "active";
        return view('template.profile.index', compact('titlePage', 'linkActived'));
    }

    public function update(Request $request)
    {
        $getOldData = User::where('id', Auth::user()->id)->firstOrFail();

        if ($getOldData->email != $request->email) {
            $request->validate([
                'email' => 'unique:users|email:rfc,dns',
            ]);
        }

        $getOldData->email = $request->email;
        $getOldData->save();

        return redirect()->back()->with('message', 'Profil Akun Berhasil di Update');
    }

    public function password()
    {
        $titlePage = "Ganti Password";
        $linkActived = "active";
        return view('template.profile.password', compact('titlePage', 'linkActived'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $getData = User::where('id', Auth::user()->id)->firstOrFail();
        $checkOldPassword = Hash::check($request->oldPassword, $getData->password);

        if ($checkOldPassword) {
            $getData->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message', 'Password Anda Berhasil di Ubah');
        }
        else{
            return redirect()->back()->with('invalid', 'Maaf Password Lama Anda Salah');
        }
    }
}
