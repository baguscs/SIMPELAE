<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $titlePage = "Profil Akun";
        $linkActived = "active";
        return view('template.profile.index', compact('titlePage', 'linkActived'));
    }
}
