<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemohonController extends Controller
{
    /**
     * Display pemohon dashboard
     */
    public function dashboard()
    {
        return view('pemohon.template-dashboard');
    }
}