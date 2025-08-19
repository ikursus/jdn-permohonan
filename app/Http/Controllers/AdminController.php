<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        // Sample data - replace with actual data from database
        $totalPermohonan = 89;
        $totalPemohon = 156;
        $tiketHelpdesk = 12;
        $recentApplications = [];
        
        return view('admin.template-dashboard', compact(
            'totalPermohonan',
            'totalPemohon', 
            'tiketHelpdesk',
            'recentApplications'
        ));
    }

    /**
     * Display pemohon management page
     */
    public function pemohon()
    {
        // Sample data - replace with actual data from database
        $totalPemohon = 156;
        $pemohonAktif = 142;
        $pemohonBaru = 8;
        $pemohonTidakAktif = 14;
        
        return view('admin.template-pemohon', compact(
            'totalPemohon',
            'pemohonAktif',
            'pemohonBaru',
            'pemohonTidakAktif'
        ));
    }

    /**
     * Display permohonan management page
     */
    public function permohonan()
    {
        // Sample data - replace with actual data from database
        $totalPermohonan = 89;
        $permohonanPending = 23;
        $permohonanApproved = 52;
        $permohonanRejected = 14;
        
        return view('admin.template-permohonan', compact(
            'totalPermohonan',
            'permohonanPending',
            'permohonanApproved',
            'permohonanRejected'
        ));
    }

    /**
     * Display helpdesk management page
     */
    public function helpdesk()
    {
        return view('admin.template-helpdesk');
    }
}