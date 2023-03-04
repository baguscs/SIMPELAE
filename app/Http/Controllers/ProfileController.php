<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
