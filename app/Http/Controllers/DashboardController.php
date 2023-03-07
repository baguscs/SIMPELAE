<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $titlePage = "Dashboard";
        $allSubmission  = Pengajuan::all()->count();
        $bornSubmission = Pengajuan::where('jenis_surats_id', 1)->get()->count();
        $dieSubmission = Pengajuan::where('jenis_surats_id', 2)->get()->count();
        $ksmSubmission = Pengajuan::where('jenis_surats_id', 3)->get()->count();
        return view('template.dashboard.index', 
        compact('titlePage', 'linkActived', 'allSubmission', 'bornSubmission', 'dieSubmission', 'ksmSubmission'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');   
    }
}
