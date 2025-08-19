<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PermohonanController extends Controller
{
    /**
     * Display list of permohonan for pemohon
     */
    public function index()
    {
        $pageTitle = 'Senarai Permohonan Pekerja';
        
        $senaraiPermohonan = [
            ['id' => 1, 'nama' => 'Ali', 'no_kp' => '808080808080', 'status' => 'pending'],
            ['id' => 2, 'nama' => 'Ahmad', 'no_kp' => '808080808080', 'status' => 'approved'],
            ['id' => 3, 'nama' => 'Siti', 'no_kp' => '808080808080', 'status' => 'rejected'],
            ['id' => 4, 'nama' => 'Upin', 'no_kp' => '808080808080', 'status' => 'pending'],
        ];
        
        return view('pemohon.permohonan.template-senarai', compact('pageTitle', 'senaraiPermohonan'));
    }

    /**
     * Show form for creating new permohonan
     */
    public function create(Request $request)
    {
        $data = $request->all();

        dd($data);

        return view('pemohon.permohonan.template-baru');
    }

    /**
     * Store new permohonan
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'nama_penuh' => 'required|string|max:255',
            'no_kp' => 'required|string|size:12|regex:/^[0-9]+$/',
            'no_telefon' => 'required|string|max:15|regex:/^[0-9+-]+$/',
            'alamat' => 'required|string|max:500',
            'jenis_permohonan' => 'required|string|in:baru,pembaharuan',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nama_penuh.required' => 'Nama penuh wajib diisi',
            'nama_penuh.max' => 'Nama penuh tidak boleh melebihi 255 aksara',
            'no_kp.required' => 'Nombor kad pengenalan wajib diisi',
            'no_kp.size' => 'Nombor kad pengenalan mesti 12 digit',
            'no_kp.regex' => 'Nombor kad pengenalan hanya boleh mengandungi angka',
            'no_telefon.required' => 'Nombor telefon wajib diisi',
            'no_telefon.regex' => 'Format nombor telefon tidak sah',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat tidak boleh melebihi 500 aksara',
            'jenis_permohonan.required' => 'Jenis permohonan wajib dipilih',
            'jenis_permohonan.in' => 'Jenis permohonan tidak sah',
            'dokumen.mimes' => 'Dokumen mesti dalam format PDF, JPG, JPEG atau PNG',
            'dokumen.max' => 'Saiz dokumen tidak boleh melebihi 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Here you would typically save to database
            // Example: Permohonan::create($validatedData);
            
            return redirect()->route('pemohon.permohonan.senarai')
                            ->with('success', 'Permohonan berjaya dihantar!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa menghantar permohonan. Sila cuba lagi.')
                ->withInput();
        }
    }

    /**
     * Display specific permohonan
     */
    public function show($id)
    {
        // Get permohonan by ID
        return view('pemohon.permohonan.template-detail', compact('id'));
    }

    /**
     * Delete permohonan
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'ID permohonan tidak sah.');
        }

        try {
            // Here you would typically delete from database
            // Example: 
            // $permohonan = Permohonan::findOrFail($id);
            // $permohonan->delete();
            
            return redirect()->route('pemohon.permohonan.senarai')
                            ->with('success', 'Permohonan berjaya dipadam!');
        } catch (\Exception $e) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'Ralat berlaku semasa memadam permohonan. Sila cuba lagi.');
        }
    }

    /**
     * Show form for editing permohonan
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'ID permohonan tidak sah.');
        }

        try {
            // Here you would typically get from database
            // Example: $permohonan = Permohonan::findOrFail($id);
            
            // For now, using sample data
            $permohonan = [
                'id' => $id,
                'nama_penuh' => 'Contoh Nama',
                'no_kp' => '123456789012',
                'no_telefon' => '0123456789',
                'alamat' => 'Contoh Alamat',
                'jenis_permohonan' => 'baru'
            ];
            
            return view('pemohon.permohonan.template-edit', compact('permohonan'));
        } catch (\Exception $e) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'Permohonan tidak dijumpai.');
        }
    }

    /**
     * Update permohonan
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permohonan $permohonan)
    {
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('pemohon.permohonan.senarai')
                ->with('error', 'ID permohonan tidak sah.');
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'nama_penuh' => 'required|string|max:255',
            'no_kp' => 'required|string|size:12|regex:/^[0-9]+$/',
            'no_telefon' => 'required|string|max:15|regex:/^[0-9+-]+$/',
            'alamat' => 'required|string|max:500',
            'jenis_permohonan' => 'required|string|in:baru,pembaharuan',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nama_penuh.required' => 'Nama penuh wajib diisi',
            'nama_penuh.max' => 'Nama penuh tidak boleh melebihi 255 aksara',
            'no_kp.required' => 'Nombor kad pengenalan wajib diisi',
            'no_kp.size' => 'Nombor kad pengenalan mesti 12 digit',
            'no_kp.regex' => 'Nombor kad pengenalan hanya boleh mengandungi angka',
            'no_telefon.required' => 'Nombor telefon wajib diisi',
            'no_telefon.regex' => 'Format nombor telefon tidak sah',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat tidak boleh melebihi 500 aksara',
            'jenis_permohonan.required' => 'Jenis permohonan wajib dipilih',
            'jenis_permohonan.in' => 'Jenis permohonan tidak sah',
            'dokumen.mimes' => 'Dokumen mesti dalam format PDF, JPG, JPEG atau PNG',
            'dokumen.max' => 'Saiz dokumen tidak boleh melebihi 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Here you would typically update in database
            // Example: 
            // $permohonan = Permohonan::findOrFail($id);
            // $permohonan->update($request->validated());
            
            return redirect()->route('pemohon.permohonan.detail', $id)
                            ->with('success', 'Permohonan berjaya dikemaskini!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa mengemaskini permohonan. Sila cuba lagi.')
                ->withInput();
        }
    }

    public function search()
    {
        return 'test search';
    }
}