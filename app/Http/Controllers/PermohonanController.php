<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Permohonan;

class PermohonanController extends Controller
{
    /**
     * Display list of permohonan for pemohon
     */
    public function index()
    {
        $pageTitle = 'Senarai Permohonan Pekerja';
        
        // Menggunakan query builder untuk mengambil data permohonan dengan join ke users table
        $senaraiPermohonan = DB::table('permohonan')
            ->join('users', 'permohonan.user_id', '=', 'users.id')
            ->select(
                'permohonan.*',
                'users.name as nama',
                'users.email'
            )
            ->where('permohonan.user_id', Auth::id())
            ->whereNull('permohonan.deleted_at')
            ->orderBy('permohonan.created_at', 'desc')
            ->get();
        
        return view('pemohon.permohonan.template-senarai', compact('pageTitle', 'senaraiPermohonan'));
    }

    /**
     * Show form for creating new permohonan
     */
    public function create(Request $request)
    {
        return view('pemohon.permohonan.template-baru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'jenis_permohonan' => 'required|string|max:100',
            'wilayah_asal' => 'required|string|max:255',
            'wilayah_ibu_negara' => 'required|string|max:255',
            'tarikh_lapor_diri' => 'required|date',
            'tarikh_terakhir_kemudahan' => 'nullable|date',
            'tarikh_kemudahan_diperlukan' => 'nullable|date',
            'pengakuan' => 'required|string',
            'pengakuan_tarikh' => 'required|date',
            'status' => 'nullable|string|in:pending,diproses,lulus,ditolak',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Simpan data ke database menggunakan query builder
            $permohonanId = DB::table('permohonan')->insertGetId([
                'user_id' => Auth::id(),
                'jenis_permohonan' => $request->jenis_permohonan,
                'wilayah_asal' => $request->wilayah_asal,
                'wilayah_ibu_negara' => $request->wilayah_ibu_negara,
                'tarikh_lapor_diri' => $request->tarikh_lapor_diri,
                'tarikh_terakhir_kemudahan' => $request->tarikh_terakhir_kemudahan,
                'tarikh_kemudahan_diperlukan' => $request->tarikh_kemudahan_diperlukan,
                'pengakuan' => $request->pengakuan,
                'pengakuan_tarikh' => $request->pengakuan_tarikh,
                'status' => $request->status ?? 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('pemohon.permohonan.senarai')
                ->with('success', 'Permohonan berjaya disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa menyimpan permohonan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Butiran Permohonan';
        
        // Ambil data permohonan dari database menggunakan query builder
        $permohonan = DB::table('permohonan')
            ->join('users', 'permohonan.user_id', '=', 'users.id')
            ->select(
                'permohonan.*', 
                'users.name as nama_pemohon', 
                'users.email'
            )
            ->where('permohonan.id', $id)
            ->where('permohonan.user_id', Auth::id())
            ->whereNull('permohonan.deleted_at')
            ->first();
        
        if (!$permohonan) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'Permohonan tidak dijumpai.');
        }
        
        return view('pemohon.permohonan.template-detail', compact('pageTitle', 'permohonan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Soft delete permohonan menggunakan query builder
            $deleted = DB::table('permohonan')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->whereNull('deleted_at')
                ->where('status', 'pending') // Hanya boleh delete jika status pending
                ->update([
                    'deleted_at' => now(),
                    'updated_at' => now(),
                ]);
            
            if (!$deleted) {
                return redirect()->back()
                    ->with('error', 'Permohonan tidak dijumpai atau tidak boleh dipadam.');
            }

            return redirect()->route('pemohon.permohonan.senarai')
                ->with('success', 'Permohonan berjaya dipadam!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa memadam permohonan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Kemaskini Permohonan';
        
        // Ambil data permohonan dari database menggunakan query builder
        $permohonan = DB::table('permohonan')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->whereNull('deleted_at')
            ->first();
        
        if (!$permohonan) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'Permohonan tidak dijumpai.');
        }
        
        // Hanya boleh edit jika status masih pending
        if ($permohonan->status !== 'pending') {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'Permohonan tidak boleh dikemaskini kerana status bukan pending.');
        }
        
        return view('pemohon.permohonan.template-kemaskini', compact('pageTitle', 'permohonan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'jenis_permohonan' => 'required|string|max:100',
            'wilayah_asal' => 'required|string|max:255',
            'wilayah_ibu_negara' => 'required|string|max:255',
            'tarikh_lapor_diri' => 'required|date',
            'tarikh_terakhir_kemudahan' => 'nullable|date',
            'tarikh_kemudahan_diperlukan' => 'nullable|date',
            'pengakuan' => 'required|string',
            'pengakuan_tarikh' => 'required|date',
            'status' => 'nullable|string|in:pending,diproses,lulus,ditolak',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update data dalam database menggunakan query builder
            $updated = DB::table('permohonan')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->whereNull('deleted_at')
                ->where('status', 'pending') // Hanya boleh update jika status pending
                ->update([
                    'jenis_permohonan' => $request->jenis_permohonan,
                    'wilayah_asal' => $request->wilayah_asal,
                    'wilayah_ibu_negara' => $request->wilayah_ibu_negara,
                    'tarikh_lapor_diri' => $request->tarikh_lapor_diri,
                    'tarikh_terakhir_kemudahan' => $request->tarikh_terakhir_kemudahan,
                    'tarikh_kemudahan_diperlukan' => $request->tarikh_kemudahan_diperlukan,
                    'pengakuan' => $request->pengakuan,
                    'pengakuan_tarikh' => $request->pengakuan_tarikh,
                    'status' => $request->status ?? 'pending',
                    'updated_at' => now(),
                ]);
            
            if (!$updated) {
                return redirect()->back()
                    ->with('error', 'Permohonan tidak dijumpai atau tidak boleh dikemaskini.')
                    ->withInput();
            }

            return redirect()->route('pemohon.permohonan.detail', $id)
                ->with('success', 'Permohonan berjaya dikemaskini!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa mengemaskini permohonan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function search()
    {
        return 'test search';
    }
}